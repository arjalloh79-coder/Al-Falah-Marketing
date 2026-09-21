<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewContactEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    public function __construct(Contact $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Enquiry: ' . $this->enquiry->first_name . ' ' . $this->enquiry->last_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_contact_enquiry',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
