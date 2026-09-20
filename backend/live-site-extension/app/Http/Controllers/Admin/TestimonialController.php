<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ContentStore;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected function store(): ContentStore
    {
        return ContentStore::for('testimonials');
    }

    public function index()
    {
        $all = $this->store()->sorted();

        return view('admin.testimonials.index', [
            'testimonials' => $all,
            'total' => count($all),
            'activeCount' => count(array_filter($all, fn ($t) => ! empty($t['is_active']))),
        ]);
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => null]);
    }

    public function edit(int $id)
    {
        $testimonial = $this->store()->find($id);

        if (! $testimonial) {
            return redirect()->route('admin.testimonials.index')
                ->with('error', 'Témoignage introuvable. / Testimonial not found.');
        }

        return view('admin.testimonials.form', ['testimonial' => $testimonial]);
    }

    public function save(Request $request, ?int $id = null)
    {
        $data = $request->validate([
            'author_name'   => 'required|string|max:150',
            'author_role_fr' => 'nullable|string|max:200',
            'author_role_en' => 'nullable|string|max:200',
            'company'       => 'nullable|string|max:150',
            'quote_fr'      => 'required|string|max:1200',
            'quote_en'      => 'nullable|string|max:1200',
            'rating'        => 'required|integer|min:1|max:5',
            'sort_order'    => 'nullable|integer|min:0|max:100000',
        ]);

        $data['rating'] = (int) $data['rating'];
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($id !== null) {
            if (! $this->store()->find($id)) {
                return redirect()->route('admin.testimonials.index')
                    ->with('error', 'Témoignage introuvable. / Testimonial not found.');
            }

            $data['id'] = $id;
        }

        $saved = $this->store()->save($data);

        return redirect()->route('admin.testimonials.index')->with(
            'success',
            $id === null
                ? "Témoignage ajouté : {$saved['author_name']}"
                : "Témoignage mis à jour : {$saved['author_name']}"
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
            return redirect()->route('admin.testimonials.index')
                ->with('error', 'Témoignage introuvable. / Testimonial not found.');
        }

        return redirect()->route('admin.testimonials.index')->with(
            'success',
            $state
                ? 'Témoignage publié. / Testimonial is now published.'
                : 'Témoignage masqué. / Testimonial is now hidden.'
        );
    }

    public function destroy(int $id)
    {
        $testimonial = $this->store()->find($id);

        if (! $testimonial) {
            return redirect()->route('admin.testimonials.index')
                ->with('error', 'Témoignage introuvable. / Testimonial not found.');
        }

        $this->store()->delete($id);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Témoignage supprimé : {$testimonial['author_name']}");
    }
}
