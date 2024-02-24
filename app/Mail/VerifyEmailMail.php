<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $portalurl;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($url, $portalurl, $email)
    {
        $this->url = $url;
        $this->portalurl = $portalurl;
        $this->email = $email;
        // dd($email);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("inwestportal@yandex.ru", "Инвестиционный портал Курской области"),
            to: [new Address($this->email, "Пользователь")],
            subject: 'Подтверждение электронной почты',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth.verify-email',
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
