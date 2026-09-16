<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Service::create($data);

        return redirect()->route('admin.services.index')->with('status', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request);
        $service->update($data);

        return redirect()->route('admin.services.index')->with('status', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'features' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_label' => ['nullable', 'string', 'max:50'],
            'currency' => ['nullable', 'string', 'max:3'],
            'category' => ['nullable', 'string', 'max:100'],
            'icon_name' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        // "features" comes in from the form as one feature per line — store as JSON array.
        if (! empty($data['features'])) {
            $data['features'] = array_values(array_filter(array_map('trim', explode("\n", $data['features']))));
        } else {
            $data['features'] = [];
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['currency'] = $data['currency'] ?? 'USD';
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
