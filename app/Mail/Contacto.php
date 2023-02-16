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

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
       /* $response = Contacto::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto($name,$email,$telefono,$mensaje));
        return $response;*/
        /*
 //return (new Contacto("juan"))->render();
    //$response = Mail::to('contacto@bsgl.mx')->send(new Contacto);
         *          */
//        $data = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto($this->name, $this->email, $this->telefono, $this->mensaje));
         //return $this->view('contacto')->from("contacto@bsgl.mx","Me")->subject("Envío de prueba");
        //return $this->view('contacto');
         return $this->view('contacto')->from("contacto@bsgl.mx","BSGL Technology & Automation")->subject("Formulario de contacto");
    }
}
