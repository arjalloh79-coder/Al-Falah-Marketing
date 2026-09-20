<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultationConfirmed;
use App\Mail\ConsultationRescheduled;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'meeting_date' => 'required|date|after_or_equal:today',
            'subject' => 'required|string',
        ]);

        Consultation::create($validated);

        return back()->with('consultation_success', 'Your consultation request has been sent successfully!');
    }

    public function index()
    {
        $consultations = Consultation::orderBy('created_at', 'desc')->get();
        return view('admin.consultations.index', compact('consultations'));
    }

    public function confirm(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);
        $lang = $request->input('lang', 'en');
        
        // Send Mail with language preference
        Mail::to($consultation->email)->send(new ConsultationConfirmed($consultation, $lang));

        $message = $lang === 'fr' 
            ? 'Consultation confirmée et email envoyé à ' . $consultation->name
            : 'Consultation confirmed and email sent to ' . $consultation->name;
            
        return back()->with('success', $message);
    }

    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'new_date' => 'required|date|after:today'
        ]);

        $consultation = Consultation::findOrFail($id);
        $old_date = $consultation->meeting_date;
        $consultation->meeting_date = $request->new_date;
        $consultation->save();

        $lang = $request->input('lang', 'en');

        // Send Mail with language preference
        Mail::to($consultation->email)->send(new ConsultationRescheduled($consultation, $old_date, $lang));

        $message = $lang === 'fr' 
            ? 'Rendez-vous reprogrammé et email envoyé.'
            : 'Meeting rescheduled and email sent.';
            
        return back()->with('success', $message);
    }
}