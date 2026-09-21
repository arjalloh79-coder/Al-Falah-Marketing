<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactEnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;
    public $lang;

    public function __construct(Contact $enquiry, string $lang = 'en')
    {
        $this->enquiry = $enquiry;
        $this->lang = $lang === 'fr' ? 'fr' : 'en';
    }

    public function envelope(): Envelope
    {
        $subject = $this->lang === 'fr'
            ? 'Nous avons bien reçu votre message - Al-Falah Marketing'
            : 'We received your message - Al-Falah Marketing';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        $view = $this->lang === 'fr'
            ? 'emails.contact_enquiry_received_fr'
            : 'emails.contact_enquiry_received';

        return new Content(
            view: $view,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
