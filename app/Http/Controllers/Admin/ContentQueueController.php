<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ContentPiece;
use App\Services\AI\ContentGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class ContentQueueController extends Controller
{
    public function index(Request $request)
    {
        $pieces = ContentPiece::query()
            ->when($request->query('type'), fn ($q, $type) => $q->where('type', $type))
            ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.content-queue.index', [
            'pieces' => $pieces,
            'types' => config('content_prompts.types'),
        ]);
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'topic' => 'nullable|string',
        ]);

        try {
            $result = app(ContentGenerator::class)->generate($data['type'], $data['topic'] ?: null);
        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        ContentPiece::create($result + ['created_by' => $request->user()->id]);

        return back()->with('success', 'New draft generated.');
    }

    public function edit(ContentPiece $contentPiece)
    {
        return view('admin.content-queue.edit', ['piece' => $contentPiece]);
    }

    public function update(Request $request, ContentPiece $contentPiece)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'required|string',
        ]);

        $contentPiece->update($data);

        return redirect()->route('admin.content-queue.index')->with('success', 'Draft updated.');
    }

    public function approve(ContentPiece $contentPiece)
    {
        // Blog posts publish immediately -- they only need the existing
        // `blogs` table, no external API. Social posts just move to
        // "approved" for now; actual publishing lands in Phase 2 once the
        // platform publishers exist.
        if ($contentPiece->type === 'blog') {
            Blog::create([
                'title' => $contentPiece->title ?: Str::limit($contentPiece->body, 60),
                'category' => $contentPiece->topic,
                'author' => auth()->user()->name,
                'content' => $contentPiece->body,
                'read_time' => $contentPiece->metadata['read_time'] ?? null,
            ]);

            $contentPiece->update(['status' => 'published', 'published_at' => now()]);

            return back()->with('success', 'Blog post published.');
        }

        $contentPiece->update(['status' => 'approved']);

        return back()->with('success', 'Draft approved -- publishing to ' . ($contentPiece->platform ?: 'the platform') . ' isn\'t wired up yet (Phase 2).');
    }

    public function reject(ContentPiece $contentPiece)
    {
        $contentPiece->update(['status' => 'rejected']);

        return back()->with('success', 'Draft rejected.');
    }

    public function destroy(ContentPiece $contentPiece)
    {
        $contentPiece->delete();

        return back()->with('success', 'Draft deleted.');
    }
}
