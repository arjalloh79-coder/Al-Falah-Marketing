@extends('admin.main')

@section('admin-content')
<div class="p-4 md:p-6 bg-slate-900 min-h-screen">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Newsletter Subscribers</h2>
            <p class="text-gray-400 text-sm mt-1">Manage your newsletter email subscribers</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.newsletter.export') }}" 
               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fas fa-file-export"></i> Export CSV
            </a>
            <button onclick="confirmBulkDelete()" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
                <i class="fas fa-trash-alt"></i> Delete Selected
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-500/20 border border-green-500/50 text-green-300 rounded-lg flex items-center gap-3">
            <i class="fas fa-check-circle text-green-400"></i>
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-500/20 border border-red-500/50 text-red-300 rounded-lg flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-red-400"></i>
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-300">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-slate-700 text-gray-100 uppercase text-xs md:text-sm">
                    <tr>
                        <th class="px-4 py-3 w-12">
                            <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes(this)" 
                                   class="w-4 h-4 rounded border-gray-600 bg-slate-700 text-primary focus:ring-primary">
                        </th>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Email Address</th>
                        <th class="px-4 py-3 hidden md:table-cell">Subscribed Date</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($subscribers as $subscriber)
                    <tr class="hover:bg-slate-750 transition">
                        <td class="px-4 py-3">
                            <input type="checkbox" class="subscriber-checkbox w-4 h-4 rounded border-gray-600 bg-slate-700 text-primary focus:ring-primary" 
                                   value="{{ $subscriber->id }}">
                        </td>
                        <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-white">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-primary text-sm"></i>
                                {{ $subscriber->email }}
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell text-gray-400">
                            {{ $subscriber->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">
                                <button onclick="deleteSubscriber({{ $subscriber->id }})" 
                                        class="text-red-400 hover:text-red-300 transition" 
                                        title="Delete Subscriber">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center gap-3">
                                <i class="fas fa-inbox text-4xl text-gray-600"></i>
                                <p class="text-lg font-semibold">No subscribers yet</p>
                                <p class="text-sm text-gray-500">Newsletter subscribers will appear here once they sign up.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($subscribers->count() > 0)
        <div class="px-4 py-3 bg-slate-700/50 border-t border-slate-700 flex justify-between items-center text-sm text-gray-400">
            <span>Total: <span class="text-white font-semibold">{{ $subscribers->count() }}</span> subscribers</span>
            <span>Showing {{ $subscribers->count() }} entries</span>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 bg-black/70 flex items-center justify-center">
    <div class="bg-slate-800 rounded-xl p-6 w-96 max-w-full mx-4">
        <h3 class="text-xl font-bold text-white mb-4">Confirm Delete</h3>
        <p class="text-gray-300 mb-6">Are you sure you want to delete this subscriber? This action cannot be undone.</p>
        <form id="deleteForm" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" 
                    class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition">
                Cancel
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                Delete
            </button>
        </form>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div id="bulkDeleteModal" class="hidden fixed inset-0 z-50 bg-black/70 flex items-center justify-center">
    <div class="bg-slate-800 rounded-xl p-6 w-96 max-w-full mx-4">
        <h3 class="text-xl font-bold text-white mb-4">Confirm Bulk Delete</h3>
        <p class="text-gray-300 mb-6">Are you sure you want to delete all selected subscribers? This action cannot be undone.</p>
        <form id="bulkDeleteForm" method="POST" action="{{ route('admin.newsletter.bulk-delete') }}" class="flex justify-end gap-3">
            @csrf
            <input type="hidden" name="ids" id="bulkDeleteIds">
            <button type="button" onclick="closeBulkDeleteModal()" 
                    class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition">
                Cancel
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                Delete All Selected
            </button>
        </form>
    </div>
</div>

<script>
    function toggleAllCheckboxes(masterCheckbox) {
        const checkboxes = document.querySelectorAll('.subscriber-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = masterCheckbox.checked;
        });
    }

    function getSelectedIds() {
        const checkboxes = document.querySelectorAll('.subscriber-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    function deleteSubscriber(id) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/newsletter/${id}`;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function confirmBulkDelete() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            alert('Please select at least one subscriber to delete.');
            return;
        }
        
        document.getElementById('bulkDeleteIds').value = JSON.stringify(ids);
        document.getElementById('bulkDeleteModal').classList.remove('hidden');
    }

    function closeBulkDeleteModal() {
        document.getElementById('bulkDeleteModal').classList.add('hidden');
    }

    // Close modals on outside click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
    document.getElementById('bulkDeleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeBulkDeleteModal();
    });
</script>
@endsection