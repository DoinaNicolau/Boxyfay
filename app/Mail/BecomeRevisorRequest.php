<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class BecomeRevisorRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $presentation;
    public function __construct(User $user, $presentation)
    {
        $this->user = $user;
        $this->presentation = $presentation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "L'utente ". $this->user->name . " ha richiesto di diventare revisore",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.become-revisor',
        );
    }
    public function attachments(): array
    {
        return [];
    }

}

  

