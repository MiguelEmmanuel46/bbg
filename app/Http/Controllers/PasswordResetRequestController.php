<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRequestController extends Controller
{
    public function sendEmail(Request $request) {  // this is most important function to send mail and inside of that there are another function
         //recoger dtaos de usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        if (!empty($params) && !empty($params_array)) {

            if (!$this->validateEmail($params_array['email'])) {  // this is validate to fail send mail or true
                return $this->failedResponse();
            }
            $this->send($params_array['email']);  //this is a function to send mail 
            return $this->successResponse();
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos'
            );
        }
    }

    public function send($email) {  //this is a function to send mail 
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email));  // token is important in send mail 
    }

    public function createToken($email) {  // this is a function to get your request email that there are or not to send mail
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email) {  // this function save new password
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    public function validateEmail($email) {  //this is a function to get your email from database
        return !!User::where('email', $email)->first();
    }

    public function failedResponse() {
         $data = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'Email no encontrado en la base de datos'
        );
         
         return response()->json($data, $data['code']);

        /*return response()->json([
                    'error' => 'Email does\'t found on our database'
                        ], Response::HTTP_NOT_FOUND);*/
    }

    public function successResponse() {
         $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Reset Email is send successfully, please check your inbox.'
            );
        /*return response()->json([
                    'data' => 'Reset Email is send successfully, please check your inbox.'
                        ], Response::HTTP_OK);*/
        
       return response()->json($data, $data['code']);
    }

}
