<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ContentStore;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected function store(): ContentStore
    {
        return ContentStore::for('services');
    }

    public function index()
    {
        $groups = $this->store()->grouped();
        $all = $this->store()->all();

        return view('admin.services.index', [
            'groups' => $groups,
            'total' => count($all),
            'activeCount' => count(array_filter($all, fn ($s) => ! empty($s['is_active']))),
        ]);
    }

    public function create()
    {
        return view('admin.services.form', [
            'service' => null,
            'categories' => $this->categories(),
        ]);
    }

    public function edit(int $id)
    {
        $service = $this->store()->find($id);

        if (! $service) {
            return redirect()->route('admin.services.index')
                ->with('error', 'Service introuvable. / Service not found.');
        }

        return view('admin.services.form', [
            'service' => $service,
            'categories' => $this->categories(),
        ]);
    }

    public function save(Request $request, ?int $id = null)
    {
        $data = $request->validate([
            'category'        => 'required|string|max:120',
            'name_fr'         => 'required|string|max:200',
            'name_en'         => 'nullable|string|max:200',
            'description_fr'  => 'nullable|string|max:1000',
            'description_en'  => 'nullable|string|max:1000',
            'duration_fr'     => 'nullable|string|max:80',
            'duration_en'     => 'nullable|string|max:80',
            'price'           => 'required|numeric|min:0|max:999999999',
            'currency'        => 'required|string|max:10',
            'period'          => 'required|in:once,month,year',
            'note_fr'         => 'nullable|string|max:500',
            'note_en'         => 'nullable|string|max:500',
            'sort_order'      => 'nullable|integer|min:0|max:100000',
        ]);

        $data['price'] = (int) round($data['price']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($id !== null) {
            if (! $this->store()->find($id)) {
                return redirect()->route('admin.services.index')
                    ->with('error', 'Service introuvable. / Service not found.');
            }

            $data['id'] = $id;
        }

        $saved = $this->store()->save($data);

        return redirect()->route('admin.services.index')->with(
            'success',
            $id === null
                ? "Service ajouté : {$saved['name_fr']}"
                : "Service mis à jour : {$saved['name_fr']}"
        );
    }

    public function update(Request $request, int $id)
    {
        return $this->save($request, $id);
    }

    public function toggle(int $id)
    {
        $state = $this->store()->toggle($id);

        if ($state === null) {
            return redirect()->route('admin.services.index')
                ->with('error', 'Service introuvable. / Service not found.');
        }

        return redirect()->route('admin.services.index')->with(
            'success',
            $state
                ? 'Service affiché sur le site. / Service is now shown on the site.'
                : 'Service masqué. / Service is now hidden.'
        );
    }

    public function destroy(int $id)
    {
        $service = $this->store()->find($id);

        if (! $service) {
            return redirect()->route('admin.services.index')
                ->with('error', 'Service introuvable. / Service not found.');
        }

        $this->store()->delete($id);

        return redirect()->route('admin.services.index')
            ->with('success', "Service supprimé : {$service['name_fr']}");
    }

    /** Categories already in use, so the dropdown stays consistent. */
    protected function categories(): array
    {
        $existing = array_values(array_unique(array_filter(
            array_map(fn ($s) => $s['category'] ?? null, $this->store()->all())
        )));

        sort($existing);

        return $existing;
    }
}
