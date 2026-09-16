<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    /**
     * Handles the general contact form (POST /contact-submit).
     * Spam prevention: honeypot field, min-length message, rate limiting (applied in routes/web.php).
     */
    public function contactSubmit(Request $request): RedirectResponse
    {
        if ($this->isHoneypotTripped($request)) {
            // Don't tell the bot it was caught — pretend success.
            return back()->with('status', 'Thanks — we\'ll be in touch soon.');
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'service_interest' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        Lead::create([
            'source' => 'contact_form',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'service_interest' => $data['service_interest'] ?? null,
            'message' => $data['message'],
            'status' => 'new',
        ]);

        return back()->with('status', 'Thanks for reaching out — we\'ll be in touch soon.');
    }

    /**
     * Handles the "Free Consultation" booking form (POST /consultation-store).
     */
    public function consultationStore(Request $request): RedirectResponse
    {
        if ($this->isHoneypotTripped($request)) {
            return back()->with('status', 'Thanks — we\'ll confirm your session shortly.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'meeting_date' => ['required', 'date', 'after_or_equal:today'],
            'subject' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        [$firstName, $lastName] = $this->splitName($data['name']);

        Lead::create([
            'source' => 'consultation_form',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $data['email'],
            'message' => $data['subject'],
            'next_step' => 'Preferred meeting date: '.$data['meeting_date'],
            'status' => 'new',
        ]);

        return back()->with('status', 'Thanks — we\'ll confirm your session shortly.');
    }

    private function isHoneypotTripped(Request $request): bool
    {
        // Hidden field named "website_url" in the form — a real visitor never fills it in.
        return filled($request->input('website_url'));
    }

    private function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name), 2);

        return [$parts[0], $parts[1] ?? null];
    }
}
