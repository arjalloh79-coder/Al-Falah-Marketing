@extends('admin.main')

@section('admin-content')

<!-- Header Section -->
<div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-6">
    <div class="text-left">
        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">User Management</h1>
        <p class="text-gray-500 text-sm mt-1">Total Users: <span class="font-bold text-primary">{{ $users->total() }}</span></p>
    </div>
    
    <div class="flex flex-col sm:flex-row gap-3">
        <!-- Search Bar (Proper UI Touch) -->
        <form action="{{ route('admin.users') }}" method="GET" class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="w-full sm:w-64 pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all">
        </form>

       <a href="{{ route('admin.users.create') }}" class="bg-primary text-dark px-6 py-3 rounded-lg font-bold text-sm uppercase tracking-wider hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 flex items-center justify-center">
      <i class="fas fa-plus mr-2"></i>
      Add New User
    </a>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 flex items-center rounded-r-lg shadow-sm">
        <i class="fas fa-check-circle mr-3"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

<!-- Users Table Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-[0.15em] font-black border-b border-gray-100">
                    <th class="px-6 py-5 hidden md:table-cell">ID</th>
                    <th class="px-6 py-5">User Details</th>
                    <th class="px-6 py-5 hidden lg:table-cell">Joined Date</th>
                    <th class="px-6 py-5">Status</th>
                    <th class="px-6 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <!-- ID Column: Hidden on Mobile -->
                    <td class="px-6 py-5 hidden md:table-cell">
                        <span class="text-xs font-bold text-slate-400">#{{ $user->id }}</span>
                    </td>

                    <!-- User Details: Always Visible -->
                    <td class="px-6 py-5">
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-slate-800 text-sm md:text-base leading-none mb-1">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 truncate max-w-[150px] md:max-w-xs">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- Joined Date: Hidden on mobile & tablet -->
                    <td class="px-6 py-5 hidden lg:table-cell">
                        <div class="text-sm text-slate-600">
                            <p class="font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </td>

                    <!-- Status: Responsive Badge -->
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wide bg-emerald-100 text-emerald-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Active
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end space-x-1">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-users-slash text-gray-300 text-2xl"></i>
                            </div>
                            <h3 class="text-slate-800 font-bold">No Users Found</h3>
                            <p class="text-gray-500 text-sm">Try adjusting your search or filters.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Area -->
    <div class="px-6 py-6 bg-white border-t border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </p>
            <div class="admin-pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    /* Custom pagination styling to match your Al-Falah theme */
    .admin-pagination nav svg { width: 20px; }
    .admin-pagination nav span, .admin-pagination nav a {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: bold;
    }
</style>
@endsection