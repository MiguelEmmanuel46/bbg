<?php

namespace App\Http\Controllers;

use App\Models\ContactoForm;
use Illuminate\Http\Request;

class ContactoFormController extends Controller {
    /* public function index(): View {
      $users = DB::table('users')->get();

      return view('user.index', ['users' => $users]);
      } */

    public function index(Request $request) {
        /*         * ********************************************************************* *********** */
        //comprobar uuario identificasdo
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);
        if ($checkToken) {
            //sacar suuario idenificado
            $user = $jwtAuth->checkToken($token, true);
            /**/
            
            $contactoform = ContactoForm::OrderBy("id","DESC")->get();
            $data = array(
                'code' => 200,
                'status' => 'succcess',
                'data' => $contactoform
            );

           
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
    
        public function show(Request $request,string $f1,string $f2) {
        /*         * ********************************************************************* *********** */
        //comprobar uuario identificasdo
        $token = $request->header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);
        if ($checkToken) {
            //sacar suuario idenificado
            $user = $jwtAuth->checkToken($token, true);
            /**/
            if (!empty($f1) && !empty($f2)) {
                $contactoform2 = ContactoForm::OrderBy("id", "DESC")->whereBetween('created_at',[$f1.' 00:00:00',$f2.' 23:59:59'])->get();
               
                $data = array(
                    'code' => 200,
                    'status' => 'succcess',
                    'data' => $contactoform2
                );
            }else{
                $data = array(
                    'code' => 200,
                    'status' => 'succcess',
                    'data' => 'se regresan todas xD'
                );
            }
           /* */
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
