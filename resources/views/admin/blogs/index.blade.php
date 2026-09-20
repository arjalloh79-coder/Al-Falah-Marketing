@extends('admin.main')

@section('admin-content')
<div class="max-w-6xl mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Blog Posts</h1>
            <p class="text-sm text-gray-500">Manage all your published and draft articles.</p>
        </div>
        <!-- Create Button -->
        <a href="{{ route('admin.blogs.create') }}" class="bg-primary text-dark px-5 py-2.5 rounded-lg font-bold hover:bg-opacity-90 transition-all flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>Write New Blog</span>
        </a>
    </div>

    <!-- Success Message Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        @if($blogs->isEmpty())
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2v3m2 3V9m0 0l-3-3m3 3L19 5" />
                </svg>
                <h3 class="text-lg font-bold text-gray-700 mb-1">No blogs written yet</h3>
                <p class="text-gray-500 mb-6">Get started by creating your very first article.</p>
                <a href="{{ route('admin.blogs.create') }}" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Write Blog</a>
            </div>
        @else
            <!-- Desktop Table view -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b text-gray-500 text-xs font-bold uppercase tracking-wider">
                            <th class="p-4 pl-6">Blog Details</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Read Time</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Published At</th>
                            <th class="p-4 text-right pr-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($blogs as $blog)
                            <tr class="hover:bg-gray-50/50 transition">
                                <!-- Image & Title -->
                                <td class="p-4 pl-6 flex items-center space-x-4">
                                    <div class="h-12 w-20 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        @if($blog->image)
                                            <img src="{{ asset('storage/' . $blog->image) }}" class="h-full w-full object-cover" alt="{{ $blog->title }}">
                                        @else
                                            <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 line-clamp-1 max-w-xs">{{ $blog->title }}</h3>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="p-4">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                        {{ $blog->category ?? 'General' }}
                                    </span>
                                </td>

                                <!-- Read Time -->
                                <td class="p-4 text-gray-600">
                                    {{ $blog->read_time ?? 'N/A' }}
                                </td>

                                <!-- Featured Status -->
                                <td class="p-4">
                                    @if($blog->is_featured)
                                        <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-xs font-bold flex items-center w-max">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Featured
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Standard</span>
                                    @endif
                                </td>

                                <!-- Date -->
                                <td class="p-4 text-gray-500 text-xs">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </td>

                                <!-- Actions -->
                                <td class="p-4 text-right pr-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Edit -->
                                        {{-- <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a> --}}

                                        <!-- Delete -->
                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Footer (if you decide to use ->paginate() later) -->
            @if(method_exists($blogs, 'links'))
                <div class="p-4 border-t bg-gray-50">
                    {{ $blogs->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection