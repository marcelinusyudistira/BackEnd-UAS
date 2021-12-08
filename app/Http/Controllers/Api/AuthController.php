<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Validator;

use Mail;
use App\Mail\AccVerifyMail;

class AuthController extends Controller
{
    public function register(Request $request){
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'name' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);
        
        $registrationData['password'] = bcrypt($request->password);
        $user = User::create($registrationData);
        $token = $user->createToken('Authentication Token')->accessToken;

        try{
            $hostlink = "https://tumbasyuk.xyz/";
            $linkbuilder = $hostlink+"?id="+$user->id+"&confirm="+$token;
            $detail = [
                'activatelink' => $linkbuilder;
            ];
            Mail::to($user->email)->send(new AccVerifyMail($detail));
        }catch(Exception $e){
            return response([
                'message' => 'Register Gagal - Error Pengiriman Pada Email',
                'user' => $user
            ], 200);
        }

        return response([
            'message' => 'Register Success',
            'user' => $user
        ], 200);
    }

    public function login(Request $request){
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if(!Auth::attempt($loginData))
            return response(['message' => 'Invalid Credentials'], 401);

        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response = ["message"=>"You have successfully logout!!"];
        return response($response,200);
    }

    public function verify(Request $request){
        $verifyData = $request->all();

        $id = $verifyData->id;
        $token = $verifyData->token;

        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        if($user->save()) {
            return response([
                'message' => 'Verify User Success',
                'data' => $user
            ], 200);
            $token->revoke();
        }
        
        return response([
            'message' => 'Verify User Failed',
            'data' => null
        ], 400);
    }
}
