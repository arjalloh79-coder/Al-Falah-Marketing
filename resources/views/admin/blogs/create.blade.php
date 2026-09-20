@extends('admin.main')
@section('admin-content')
<div class="max-w-4xl mx-auto bg-dark p-8 rounded-2xl shadow-sm border">
    <h2 class="text-2xl font-bold mb-6">Write New Blog Post</h2>
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" class="w-full p-3 border rounded-lg" required>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Category</label>
                <select name="category" class="w-full p-3 border rounded-lg">
                    <option>Web Design</option>
                    <option>SEO Tips</option>
                    <option>AI Marketing</option>
                </select>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-bold mb-2">Featured Image</label>
            <input type="file" name="image" class="w-full p-2 border rounded-lg" required>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2">Content</label>
            <textarea name="content" rows="10" class="w-full p-3 border rounded-lg"></textarea>
        </div>

        <div class="flex items-center space-x-4">
            <input type="text" name="read_time" placeholder="e.g. 5 Min Read" class="p-3 border rounded-lg">
            <label class="flex items-center">
                <input type="checkbox" name="is_featured" class="mr-2"> Featured Post?
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold">Publish Blog</button>
    </form>
</div>
@endsection