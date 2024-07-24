<?php

// EnviarInvitacionMatrimonio.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarInvitacionMatrimonio extends Mailable
{
    use Queueable, SerializesModels;

    protected $matrimonio;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($matrimonio)
    {
        $this->matrimonio = $matrimonio;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitacion de Matrimonio',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.Enviarinvitacion')
            ->with('matrimonio', $this->matrimonio);
    }
}
