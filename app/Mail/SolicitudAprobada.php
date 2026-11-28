<?php

namespace App\Mail;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudAprobada extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Solicitud $solicitud,
        public User $usuario,
        public string $contrasenaTemporal,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu solicitud fue aprobada - Institución Educativa Salvatore',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.solicitudes.aprobada',
            text: 'emails.solicitudes.aprobada-text',
        );
    }
}
