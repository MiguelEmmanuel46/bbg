<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class Contacto extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $telefono;
    public $mensaje;

    public function __construct($name, $email, $telefono, $mensaje)
    {
        $this->name = $name;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *sendemail
     * @return $this
     */
    public function build()
    {
       return $this->view('contacto')->from("contacto@bsgl.mx","BSGL Technology & Automation")->subject("Formulario de contacto");
    }
}
