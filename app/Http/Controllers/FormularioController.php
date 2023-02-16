<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;


class FormularioController extends Controller
{
    public function index(Request $request) {

        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        
        if (!empty($params) && !empty($params_array)) {


            //limpiardatoscomment
            $params_array = array_map('trim', $params_array);
            //validar datos
            $validate = \Validator::make($params_array, [
                        'name' => 'required|regex:/^[\pL\s\-]+$/u',
                        'email' => 'required|email',
                        'telefono' => 'required',
                        'mensaje' => 'required'
            ]);

            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Error datos formulario ',
                    'errors' => $validate->errors()
                );
            } else {

                
                $name = $params_array['name'];
                $email = $params_array['email'];
                $telefono = $params_array['telefono'];
                $mensaje = $params_array['mensaje'];
                //$data = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send();
                 Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto($name, $email, $telefono, $mensaje));
                 $data = array(
                    'status' => 'succes',
                    'code' => 200,
                    'message' => 'Tu mensaje se ha enviado correctamente, pronto nuestro equipo se pondra en contacto contigo, gracias. '
                );

                //$data = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto($nombre, $email, $telefono, $mensaje));
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }


        return response()->json([$data,$data['message']]);
    }

}
