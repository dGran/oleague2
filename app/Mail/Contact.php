<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function build()
    {
        return $this->markdown('emails.contact')->from('lpx.torneos@gmail.com')
        ->subject('Mensaje recibido desde formulario de contacto')
        ->with('datos', $this->datos);
    }
}
