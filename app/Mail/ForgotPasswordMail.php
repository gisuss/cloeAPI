<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected string $url;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $pin)
    {
        $this->user = $user;
        $this->url = 'https://cloe-fe.vercel.app/auth/change-password/' . $pin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Restablecimiento de contraseña',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.auth.ForgotPasswordMail',
            with: [
                'user' => $this->user,
                'url' => $this->url
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

}
