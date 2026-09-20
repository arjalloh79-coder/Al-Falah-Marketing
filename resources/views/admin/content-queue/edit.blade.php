@extends('admin.main')

@section('admin-content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('admin.content-queue.index') }}" class="text-sm text-primary">&larr; Back to Content Queue</a>
        <h1 class="text-3xl font-bold text-slate-800 mt-2">
            {{ config('content_prompts.types.' . $piece->type . '.label', $piece->type) }}
        </h1>
        <p class="text-gray-500 mt-1">
            Topic: {{ $piece->topic }} &middot; Status:
            <span class="font-semibold">{{ ucfirst($piece->status) }}</span>
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>&bull; {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.content-queue.update', $piece) }}" method="POST" class="bg-white p-6 rounded-2xl shadow-sm border space-y-4">
        @csrf
        @method('PUT')

        @if ($piece->type === 'blog')
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $piece->title) }}"
                    class="w-full border rounded-lg p-3">
            </div>
        @endif

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">
                {{ $piece->type === 'youtube_script' ? 'Scenes (JSON)' : 'Body' }}
            </label>
            <textarea name="body" rows="16" class="w-full border rounded-lg p-3 font-mono text-sm">{{ old('body', $piece->body) }}</textarea>
        </div>

        @if (! empty($piece->metadata))
            <div class="text-sm text-gray-500 border-t pt-4">
                <span class="font-medium">Metadata:</span> {{ json_encode($piece->metadata) }}
            </div>
        @endif

        <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            Save Changes
        </button>
    </form>

    @if ($piece->status === 'draft')
        <div class="flex items-center gap-3 mt-4">
            <form action="{{ route('admin.content-queue.approve', $piece) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    Approve{{ $piece->type === 'blog' ? ' & Publish' : '' }}
                </button>
            </form>
            <form action="{{ route('admin.content-queue.reject', $piece) }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-500 font-medium px-4 py-3">Reject</button>
            </form>
        </div>
        <p class="text-xs text-gray-400 mt-2">Save any edits above first -- Approve/Reject act on the last saved version.</p>
    @endif

</div>

@endsection
