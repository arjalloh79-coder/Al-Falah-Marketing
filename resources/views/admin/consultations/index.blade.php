@extends('admin.main')

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Meeting Enquiries</h2>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-500 text-white rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-slate-800 rounded-xl overflow-hidden shadow-lg">
        <table class="w-full text-left text-gray-300">
            <thead class="bg-slate-700 text-gray-100 uppercase text-sm">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Meeting Date</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @foreach($consultations as $item)
                <tr class="hover:bg-slate-750 transition">
                    <td class="px-6 py-4 font-medium text-white">{{ $item->name }}</td>
                    <td class="px-6 py-4">{{ $item->email }}</td>
                    <td class="px-6 py-4 text-accent font-bold">{{ date('M d, Y', strtotime($item->meeting_date)) }}</td>
                    <td class="px-6 py-4 text-sm">{{ Str::limit($item->subject, 30) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col sm:flex-row justify-center gap-2">
                            <!-- Language Selection Dropdown -->
                            <div class="flex items-center gap-1">
                                <select id="lang_select_{{ $item->id }}" class="bg-slate-700 text-white text-sm rounded px-2 py-1 border border-slate-600">
                                    <option value="en">🇬🇧 English</option>
                                    <option value="fr">🇫🇷 French</option>
                                </select>
                            </div>
                            
                            <!-- Confirm Button -->
                            <button onclick="confirmWithLanguage('{{ $item->id }}', 'confirm')" 
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition whitespace-nowrap">
                                <i class="fas fa-check mr-1"></i> Confirm
                            </button>

                            <!-- Reschedule Button -->
                            <button onclick="openRescheduleModal('{{ $item->id }}', '{{ $item->meeting_date }}')" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition whitespace-nowrap">
                                <i class="fas fa-calendar-alt mr-1"></i> Re-schedule
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Reschedule Modal -->
<div id="rescheduleModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-bold mb-4">Re-schedule Meeting</h3>
        <form id="rescheduleForm" method="POST">
            @csrf
            <input type="hidden" id="consultation_id">
            <input type="hidden" id="reschedule_lang" name="lang" value="en">
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Select New Date</label>
                <input type="date" name="new_date" id="new_date" required class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Send email in:</label>
                <select name="lang" id="modal_lang_select" class="w-full border p-2 rounded">
                    <option value="en">🇬🇧 English</option>
                    <option value="fr">🇫🇷 French</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-500">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update & Send Mail</button>
            </div>
        </form>
    </div>
</div>

<script>
    function confirmWithLanguage(id, action) {
        const langSelect = document.getElementById(`lang_select_${id}`);
        const lang = langSelect ? langSelect.value : 'en';
        
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/consultations/${id}/${action}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        const langInput = document.createElement('input');
        langInput.type = 'hidden';
        langInput.name = 'lang';
        langInput.value = lang;
        form.appendChild(langInput);
        
        document.body.appendChild(form);
        form.submit();
    }

    function openRescheduleModal(id, currentDate) {
        const modal = document.getElementById('rescheduleModal');
        const form = document.getElementById('rescheduleForm');
        form.action = `/admin/consultations/${id}/reschedule`;
        document.getElementById('consultation_id').value = id;
        document.getElementById('new_date').value = currentDate;
        
        // Set language from the row's dropdown
        const langSelect = document.getElementById(`lang_select_${id}`);
        if (langSelect) {
            document.getElementById('modal_lang_select').value = langSelect.value;
        }
        
        // Update hidden lang input when modal select changes
        document.getElementById('modal_lang_select').onchange = function() {
            document.getElementById('reschedule_lang').value = this.value;
        };
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('rescheduleModal').classList.add('hidden');
    }
</script>
@endsection