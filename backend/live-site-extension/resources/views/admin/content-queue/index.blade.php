@extends('admin.main')

@section('admin-content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Content Queue</h1>
        <p class="text-gray-500 mt-2">
            AI-generated drafts waiting for review. Blog posts publish immediately on approval; social posts move
            to "approved" and wait for Phase 2 (direct publishing) to actually go out.
        </p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6">{{ session('error') }}</div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-sm border mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Generate a new draft</h2>
        <form action="{{ route('admin.content-queue.generate') }}" method="POST" class="flex flex-wrap items-end gap-4">
            @csrf
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Type</label>
                <select name="type" required class="border rounded-lg p-3">
                    @foreach ($types as $key => $info)
                        <option value="{{ $key }}">{{ $info['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Topic (optional)</label>
                <select name="topic" class="border rounded-lg p-3">
                    <option value="">Random</option>
                    @foreach (config('content_prompts.topics') as $topic)
                        <option value="{{ $topic }}">{{ $topic }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Generate
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-3">Title / Topic</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Created</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($pieces as $piece)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-800">{{ $piece->title ?: \Illuminate\Support\Str::limit($piece->body, 60) }}</div>
                            <div class="text-xs text-gray-500">{{ $piece->topic }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $types[$piece->type]['label'] ?? $piece->type }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                @class([
                                    'bg-gray-100 text-gray-600' => $piece->status === 'draft',
                                    'bg-green-100 text-green-700' => in_array($piece->status, ['approved', 'published']),
                                    'bg-red-100 text-red-600' => in_array($piece->status, ['rejected', 'failed']),
                                ])">
                                {{ ucfirst($piece->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $piece->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-3 text-sm space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.content-queue.edit', $piece) }}" class="text-primary font-medium">Edit</a>
                            @if ($piece->status === 'draft')
                                <form action="{{ route('admin.content-queue.approve', $piece) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 font-medium">Approve</button>
                                </form>
                                <form action="{{ route('admin.content-queue.reject', $piece) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-500 font-medium">Reject</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.content-queue.destroy', $piece) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete this draft permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">No content yet -- generate your first draft above.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $pieces->links() }}
    </div>

</div>

@endsection
