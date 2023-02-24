<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordController extends Controller
{
    /*public function passwordResetProcess(UpdatePasswordRequest $request) {
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
    }*/
     public function passwordResetProcess(Request $request) {
          //recoger dtaos de usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        if (!empty($params) && !empty($params_array)) {
            return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'passwordResetProcess error'
            );
        }
    }

    // Verify if token is valid
    private function updatePasswordRow(Request $request) {
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        if (!empty($params) && !empty($params_array)) {
            return DB::table('password_resets')->where([
                        'email' => $params_array['email'],
                        'token' => $params_array['resetToken']
            ]);
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'update password row incorrect'
            );
        }
    }

    // Token not found response  
    private function tokenNotFoundError() {
        return response()->json([
                    'error' => 'Either your email or token is wrong.'
                        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    // Reset password
    private function resetPassword(Request $request) {
        
        //recoger dtaos de usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        
          if (!empty($params) && !empty($params_array)) {
            // find email
        $userData = User::whereEmail($params_array['email'])->first();
        // update password
         $pwd = hash('sha256', $params_array['password']);
        $userData->update([
            'password' => $pwd
        ]);
        // remove verification data from db
        $this->updatePasswordRow($request)->delete();
        $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Contraseña actualizada.'
            );
            /*return response()->json([
                        'data' => 'Password has been updated.'
                            ], Response::HTTP_CREATED);*/
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }
        // reset password response
         return response()->json($data);
        
    }

}
