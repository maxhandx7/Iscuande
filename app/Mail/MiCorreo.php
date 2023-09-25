<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MiCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nombrePaciente;
    public $estado;

    public function __construct($nombrePaciente, $estado)
    {
        $this->nombrePaciente = $nombrePaciente;
        $this->estado = $estado;
    }

    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Actualización de estado')->view('admin.config.estadoMail') ->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('X-Gmail-Labels', 'Notificaciones');
        });
    }
}
