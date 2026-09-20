<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationRescheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;
    public $old_date;
    public $lang;

    /**
     * Create a new message instance.
     */
    public function __construct($consultation, $old_date, $lang = 'en')
    {
        $this->consultation = $consultation;
        $this->old_date = $old_date;
        $this->lang = $lang;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->lang === 'fr' 
            ? 'Rendez-vous reprogrammé - Al-Falah Agency' 
            : 'Meeting Re-scheduled - Al-Falah Agency';
            
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->lang === 'fr' 
            ? 'emails.consultation_rescheduled_fr' 
            : 'emails.consultation_rescheduled';
            
        return new Content(
            view: $view,
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}