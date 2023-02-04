<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Contacto;

class ContactoController extends Controller {

    //
    /* public function pruebas(Request $request){
      return "action of try for CONTACTO contrller";
      } */
    public function __construct() {
        /* $this->middleware('api.auth', ['except' => ['index','show']]); */
    }

    //
    public function index() {
        $servicios = Contacto::all()->load('servicios');
        return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'servicios' => $servicios
        ]);
    }

    public function show($id) {
        $result = Contacto::find($id)->load('servicios');
        if (is_object($result)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'servicios' => $result
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'this service doesn´t exists'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function store(Request $request) {
        /*         * ********************************************************************* *********** */
        //comprobar uuario identificasdo
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);
        if ($checkToken) {
            //sacar suuario idenificado
            $user = $jwtAuth->checkToken($token, true);
            /**/
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array = json_decode($json, true);
            if (!empty($params_array)) {

                $validate = \Validator::make($params_array, [
                    'nombre' => 'required',
                    'correo' => 'required|email',
                    'telefono' => 'required',
                    'servicio_id' => 'required',
                    'descripcion' => 'required',
                    'fecha_cotizacion' => 'required'
                ]);

                if ($validate->fails()) {
                    $signup = array(
                        'status' => 'error',
                        'code' => 404,
                        'message' => 'No se ha guardado el formuario de ocntacto'
                        . ' ',
                        'errors' => $validate->errors()
                    );
                } else {
                    $contacto = new Contacto();
                    $contacto->nombre = $params_array['nombre'];
                    $contacto->correo = $params_array['correo'];
                    $contacto->telefono = $params_array['telefono'];
                    $contacto->servicio_id = $params_array['servicio_id'];
                    $contacto->descripcion = $params_array['descripcion'];
                    $contacto->fecha_cotizacion = $params_array['fecha_cotizacion'];
                    $contacto->save();
                    $data = array(
                        'code' => 200,
                        'status' => 'succcess',
                        'message' => 'Formulario de contatco enviado, pronto nos contactaremos contigo.'
                    );
                }
            } else {
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'nose ha enviado ningun dato'
                );
            }
            /**/
        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'El usuario no esta identificado'
            );
        }
        /*         * ******************************************************************************** */
        return response()->json($data, $data['code']);
    }

    public function update($id, Request $request) {
        /*         * ********************************************************************* *********** */
        //comprobar uuario identificasdo
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);
        if ($checkToken) {
            //sacar suuario idenificado
            $user = $jwtAuth->checkToken($token, true);
            /**/
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array = json_decode($json, true);
            if (!empty($params_array)) {

                $validate = \Validator::make($params_array, [
                    
                    'correo' => 'email'
               
                ]);
                unset($params_array['id']);
                unset($params_array['created_at']);
                unset($params_array['update_at']);

                if ($validate->fails()) {
                    $signup = array(
                        'status' => 'error',
                        'code' => 404,
                        'message' => 'No se ha guardado el servicio'
                        . ' ',
                        'errors' => $validate->errors()
                    );
                } else {
                    unset($params_array['id']);
                    unset($params_array['created_at']);
                    $contacto = Contacto::where('id', $id)->update($params_array);

                    $data = array(
                        'code' => 200,
                        'status' => 'succcess',
                        'servicio' => $params_array
                    );
                }
            } else {
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'nose ha enviado ningun serviio para actualizar'
                );
            }
            /**/
        } else {
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'El usuario no esta identificado'
            );
        }
        /*         * ******************************************************************************** */
        return response()->json($data, $data['code']);
    }

}
