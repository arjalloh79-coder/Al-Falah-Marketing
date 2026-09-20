@extends('admin.main') 

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-white">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Portfolio</h2>
        <a href="{{ route('admin.portfolio.create') }}" class="bg-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Add New Project
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-slate-800 rounded-xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-700 text-gray-300 text-sm uppercase">
                    <th class="p-4">Image</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Target</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @foreach($projects as $project)
                <tr>
                    <td class="p-4">
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-16 h-12 object-cover rounded-md">
                    </td>
                    <td class="p-4 font-semibold">{{ $project->title }}</td>
                    <td class="p-4"><span class="bg-slate-700 px-2 py-1 rounded text-xs">{{ $project->category }}</span></td>
                    <td class="p-4 text-sm text-gray-400">{{ $project->target_market }}</td>
                    <td class="p-4">
                        <form action="{{ route('admin.portfolio.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection