<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->exists ? 'Edit service' : 'Add service' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="space-y-6">
                    @csrf
                    @if ($service->exists) @method('PUT') @endif

                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $service->name) }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="short_description" value="Short description" />
                        <x-text-input id="short_description" name="short_description" type="text" class="mt-1 block w-full" value="{{ old('short_description', $service->short_description) }}" />
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Full description" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $service->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="features" value="Features (one per line)" />
                        <textarea id="features" name="features" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea>
                        <x-input-error :messages="$errors->get('features')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="price" value="Price" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price', $service->price) }}" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="price_label" value="Price label (e.g. /mo)" />
                            <x-text-input id="price_label" name="price_label" type="text" class="mt-1 block w-full" value="{{ old('price_label', $service->price_label) }}" />
                            <x-input-error :messages="$errors->get('price_label')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="category" value="Category" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" value="{{ old('category', $service->category) }}" />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="icon_name" value="Icon name" />
                            <x-text-input id="icon_name" name="icon_name" type="text" class="mt-1 block w-full" value="{{ old('icon_name', $service->icon_name) }}" />
                            <x-input-error :messages="$errors->get('icon_name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image_url" value="Image URL" />
                        <x-text-input id="image_url" name="image_url" type="text" class="mt-1 block w-full" value="{{ old('image_url', $service->image_url) }}" />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="sort_order" value="Sort order" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" value="{{ old('sort_order', $service->sort_order ?? 0) }}" />
                            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>
                        <div class="flex items-end">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Active (visible on site)</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Save</x-primary-button>
                        <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
