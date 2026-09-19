@extends('admin.main')

@section('admin-content')
<div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-center">
    <div class="bg-white rounded-3xl p-8 lg:p-10 max-w-2xl w-full border border-slate-100 shadow-sm transition-all duration-300">

        <div class="mb-8 border-b border-slate-100 pb-5">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Create Portfolio Project</h2>
            <p class="text-sm text-slate-500 mt-1">Add a new success story to show your global audience your marketing impact.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6">
                <p class="font-semibold mb-1">Couldn't save this project:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project Title / Client Name</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium"
                    placeholder="e.g., Elite Realty Group">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Category</label>
                    <div class="relative">
                        <select name="category" required
                            class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium appearance-none cursor-pointer">
                            @foreach (['Web Design', 'SEO & Ads', 'AI Automation', 'E-commerce'] as $category)
                                <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Launch Year</label>
                    <input type="text" name="year" value="{{ old('year') }}" placeholder="2026" required maxlength="4"
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Target Market Location</label>
                    <input type="text" name="target_market" value="{{ old('target_market') }}" placeholder="e.g., USA, New York" required
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Results Badge (Metric)</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text') }}" placeholder="e.g., +300% Leads" required
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project External URL (Optional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-link text-sm"></i>
                    </div>
                    <input type="url" name="project_url" value="{{ old('project_url') }}" placeholder="https://example.com"
                        class="w-full h-12 pl-11 pr-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project Mockup Image</label>
                <div class="relative border-2 border-dashed border-slate-200 hover:border-primary rounded-2xl bg-slate-50/50 transition-colors p-6 text-center cursor-pointer group">
                    <input type="file" name="image" id="projectImage" required
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="updateFileName(this)">

                    <div class="space-y-2">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mx-auto text-slate-400 group-hover:text-primary transition-colors border border-slate-100">
                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-700" id="uploadPlaceholder">Click to upload mockup image</p>
                        <p class="text-xs text-slate-400">PNG, JPG, JPEG or WEBP up to 2MB</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center space-x-4">
                <a href="{{ route('admin.portfolio.index') }}"
                    class="flex-1 h-12 rounded-xl font-bold text-sm uppercase tracking-wider flex items-center justify-center bg-slate-100 text-slate-600 hover:bg-slate-200/80 transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="flex-1 h-12 rounded-xl font-bold text-sm uppercase tracking-wider transition-all active:scale-95"
                    style="background: #2563eb; color: #ffffff; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);">
                    Save Project
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function updateFileName(input) {
        const placeholder = document.getElementById('uploadPlaceholder');
        if (input.files && input.files[0]) {
            placeholder.innerText = "Selected: " + input.files[0].name;
            placeholder.classList.remove('text-slate-700');
            placeholder.classList.add('text-primary');
        } else {
            placeholder.innerText = "Click to upload mockup image";
            placeholder.classList.remove('text-primary');
            placeholder.classList.add('text-slate-700');
        }
    }
</script>
@endsection
