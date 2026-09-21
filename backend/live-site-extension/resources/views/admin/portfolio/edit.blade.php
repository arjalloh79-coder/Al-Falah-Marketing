@extends('admin.main')

@section('admin-content')
<div class="min-h-screen bg-slate-50/50 py-12 px-4 sm:px-6 lg:px-8 flex justify-center items-center">
    <div class="bg-white rounded-3xl p-8 lg:p-10 max-w-2xl w-full border border-slate-100 shadow-sm transition-all duration-300">

        <div class="mb-8 border-b border-slate-100 pb-5">
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Edit Portfolio Project</h2>
            <p class="text-sm text-slate-500 mt-1">Update project details and website links for your portfolio.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6">
                <p class="font-semibold mb-1">Couldn't update this project:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.portfolio.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project Title / Client Name</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                    class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium"
                    placeholder="e.g., Elite Realty Group">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Category</label>
                    <div class="relative">
                        <select name="category" required
                            class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium appearance-none cursor-pointer">
                            @foreach (['Digital Marketing', 'Web Design', 'E-Commerce', 'SEO Tips', 'AI & Automation', 'Social Media', 'Content Strategy', 'Business Growth', 'Technology', 'Other'] as $category)
                                <option value="{{ $category }}" @selected(old('category', $project->category) === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Launch Year</label>
                    <input type="text" name="year" value="{{ old('year', $project->year) }}" placeholder="2026" required maxlength="4"
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Target Market Location</label>
                    <input type="text" name="target_market" value="{{ old('target_market', $project->target_market) }}" placeholder="e.g., USA, New York" required
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Results Badge (Metric)</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $project->badge_text) }}" placeholder="e.g., +300% Leads" required
                        class="w-full h-12 px-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project External URL (Optional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-link text-sm"></i>
                    </div>
                    <input type="url" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://example.com"
                        class="w-full h-12 pl-11 pr-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Live Website URL (on Hostinger)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-globe text-sm"></i>
                    </div>
                    <input type="url" name="website_url_live" value="{{ old('website_url_live', $project->website_url_live) }}" placeholder="https://client-website.com"
                        class="w-full h-12 pl-11 pr-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
                @if($project->website_url_live)
                    <p class="text-xs text-slate-500 mt-2">
                        <a href="{{ $project->website_url_live }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-semibold">
                            <i class="fas fa-arrow-up-right-from-square text-xs mr-1"></i>Visit Live Site
                        </a>
                    </p>
                @endif
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Staging Website URL (Optional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-code-branch text-sm"></i>
                    </div>
                    <input type="url" name="website_url_staging" value="{{ old('website_url_staging', $project->website_url_staging) }}" placeholder="https://staging.client-website.com"
                        class="w-full h-12 pl-11 pr-4 bg-slate-50 rounded-xl border border-slate-200 text-slate-800 outline-none transition-all duration-200 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 font-medium">
                </div>
                @if($project->website_url_staging)
                    <p class="text-xs text-slate-500 mt-2">
                        <a href="{{ $project->website_url_staging }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline font-semibold">
                            <i class="fas fa-arrow-up-right-from-square text-xs mr-1"></i>Visit Staging Site
                        </a>
                    </p>
                @endif
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project Mockup Image (Optional)</label>
                @if($project->image)
                    <div class="mb-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <p class="text-xs text-slate-600 mb-3">Current Image:</p>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="max-h-48 rounded-lg border border-slate-200">
                    </div>
                @endif
                <div class="relative border-2 border-dashed border-slate-200 hover:border-primary rounded-2xl bg-slate-50/50 transition-colors p-6 text-center cursor-pointer group">
                    <input type="file" name="image" id="projectImage"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="updateFileName(this)">

                    <div class="space-y-2">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mx-auto text-slate-400 group-hover:text-primary transition-colors border border-slate-100">
                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                        </div>
                        <p class="text-sm font-semibold text-slate-700" id="uploadPlaceholder">Click to upload a new mockup image</p>
                        <p class="text-xs text-slate-400">PNG, JPG, JPEG or WEBP up to 2MB (leave blank to keep current)</p>
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
                    Update Project
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
            placeholder.innerText = "Click to upload a new mockup image";
            placeholder.classList.remove('text-primary');
            placeholder.classList.add('text-slate-700');
        }
    }
</script>
@endsection
