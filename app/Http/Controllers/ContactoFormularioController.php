<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contacto;

class ContactoFormulario extends Controller
{
   /*
        //return (new Contacto("juan"))->render();
        //$response = Mail::to('contacto@bsgl.mx')->send(new Contacto);
        $response = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto("Prueba","popo@gmail.com","2225790336","Quiero informacion de bancos de p"));

    var_dump($response); 
     */
    public function index(Request $request){
        
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        var_dump($params_array);
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
                
                $cf = new Contacto();
                $cf->name = $params_array['name'];
                $cf->email = $params_array['email'];
                $cf->telefono = $params_array['telefono'];
                $cf->mensaje = $params_array['mensaje'];
               $cf->build($name,$email,$telefono,$mensaje); 
             //$data = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto($nombre, $email, $telefono, $mensaje));
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }


        return response()->json($data, $data['code']);
    }
}
