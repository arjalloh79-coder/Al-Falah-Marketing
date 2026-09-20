<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;
    public $lang;

    /**
     * Create a new message instance.
     */
    public function __construct($consultation, $lang = 'en')
    {
        $this->consultation = $consultation;
        $this->lang = $lang;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->lang === 'fr' 
            ? 'Rendez-vous confirmé - Al-Falah Agency' 
            : 'Meeting Confirmed - Al-Falah Agency';
            
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
            ? 'emails.consultation_confirmed_fr' 
            : 'emails.consultation_confirmed';
            
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