<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Support\ContentStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    // ==========================================
    // यूज़र साइड: प्रोजेक्ट्स डिस्प्ले करना
    // ==========================================
    public function index()
    {
        $projects = Portfolio::latest()->get();

        $testimonials = collect(ContentStore::for('testimonials')->sorted())
            ->filter(fn ($t) => ! empty($t['is_active']))
            ->values();

        return view('User.portfolio', compact('projects', 'testimonials'));
    }

    // ==========================================
    // एडमिन साइड: प्रोजेक्ट्स मैनेज करना (CRUD)
    // ==========================================
    public function adminIndex()
    {
        $projects = Portfolio::latest()->get();
        return view('admin.portfolio.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_market' => 'required|string|max:255',
            'badge_text' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'project_url' => 'nullable|url'
        ]);

        // इमेज अपलोड हैंडलिंग
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios', 'public');
        }

        Portfolio::create([
            'title' => $request->title,
            'category' => $request->category,
            'target_market' => $request->target_market,
            'badge_text' => $request->badge_text,
            'year' => $request->year,
            'image' => $imagePath ?? null,
            'project_url' => $request->project_url
        ]);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project added successfully!');
    }

    public function edit($id)
    {
        $project = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Portfolio::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_market' => 'required|string|max:255',
            'badge_text' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'project_url' => 'nullable|url',
            'website_url_live' => 'nullable|url',
            'website_url_staging' => 'nullable|url'
        ]);

        $data = $request->only(['title', 'category', 'target_market', 'badge_text', 'year', 'project_url', 'website_url_live', 'website_url_staging']);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Portfolio::findOrFail($id);
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Project deleted successfully!');
    }
}