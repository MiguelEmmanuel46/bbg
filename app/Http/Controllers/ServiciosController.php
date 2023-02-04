<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Servicios;

class ServiciosController extends Controller {

    public function __construct() {
        /* $this->middleware('api.auth', ['except' => ['index','show']]); */
    }

    //
    public function index() {
        $servicios = Servicios::all();
        return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'servicios' => $servicios
        ]);
    }

    public function show($id) {
        $result = Servicios::find($id);
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

                $validate = \Validator::make($params_array, ['name' => 'required']);

                if ($validate->fails()) {
                    $signup = array(
                        'status' => 'error',
                        'code' => 404,
                        'message' => 'No se ha guardado el servicio'
                        . ' ',
                        'errors' => $validate->errors()
                    );
                } else {
                    $servicios = new Servicios();
                    $servicios->nombre_servicio = $params_array['name'];
                    $servicios->save();
                    $data = array(
                        'code' => 200,
                        'status' => 'succcess',
                        'message' => 'servicio guardado'
                    );
                }
            } else {
                $data = array(
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'nose ha enviado ningun serviio'
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

    public function update($id,Request $request) {
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

                $validate = \Validator::make($params_array, ['nombre_servicio' => 'required']);

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
                   $servicios = Servicios::where('id', $id)->update($params_array);
                    
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
