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
            
            $contactoform = ContactoForm::all();
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

}
