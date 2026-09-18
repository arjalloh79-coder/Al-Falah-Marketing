<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected function path(): string
    {
        return storage_path('app/content/settings.json');
    }

    protected function current(): array
    {
        if (! is_file($this->path())) {
            return [];
        }

        return json_decode(file_get_contents($this->path()), true) ?: [];
    }

    public function edit()
    {
        return view('admin.settings', [
            'settings' => $this->current(),
            'cardEnabled' => filled(env('STRIPE_SECRET_KEY')),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'orange_money_number' => 'nullable|string|max:100',
            'orange_money_name' => 'nullable|string|max:150',
            'mtn_money_number' => 'nullable|string|max:100',
            'mtn_money_name' => 'nullable|string|max:150',
            'moov_money_number' => 'nullable|string|max:100',
            'moov_money_name' => 'nullable|string|max:150',
            'wave_number' => 'nullable|string|max:100',
            'wave_name' => 'nullable|string|max:150',
            'bank_name' => 'nullable|string|max:150',
            'bank_account_name' => 'nullable|string|max:150',
            'bank_account_number' => 'nullable|string|max:150',
            'bank_details' => 'nullable|string|max:500',
        ]);

        // Checkboxes are only present in the request when checked, so read
        // each *_enabled flag explicitly rather than relying on $request->validate().
        foreach (['orange_money', 'mtn_money', 'moov_money', 'wave', 'bank'] as $method) {
            $data["{$method}_enabled"] = $request->boolean("{$method}_enabled");
        }

        $dir = dirname($this->path());
        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        file_put_contents(
            $this->path(),
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        return back()->with('success', 'Payment settings updated.');
    }
}
