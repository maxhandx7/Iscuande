<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class citaCreada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nombrePaciente;
    public $FechaCita;
    public $HoraCita;

    
    public function __construct($nombrePaciente, $FechaCita, $HoraCita)
    {
        $this->nombrePaciente = $nombrePaciente;
        $this->FechaCita = $FechaCita;
        $this->HoraCita = $HoraCita;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.config.citaCreateMail');
    }
}
