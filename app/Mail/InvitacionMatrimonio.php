<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Matrimonio;

class InvitacionMatrimonio extends Mailable
{
    use Queueable, SerializesModels;

    public $matrimonio;

    public function __construct(Matrimonio $matrimonio)
    {
        $this->matrimonio = $matrimonio;
    }

    public function build()
    {
        return $this->markdown('emails.invitacion')
            ->with('matrimonio', $this->matrimonio);
    }
}
