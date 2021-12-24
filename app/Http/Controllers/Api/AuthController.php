<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTSubject;
use Exceptions;

class AuthController extends Controller
{
    public function login(Request $request){

        $creds = $request->only(['email', 'password']);
        $token = null;

        if(!$token=auth()->attempt($creds)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid credential'
            ]);
        }
        return response()->json([
            'success'=>true,
            'token'=>$token,
            'user'=>Auth::user()
        ]);
    }

    public function register(Request $request){
        $hashPass = Hash::make($request->password);

        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hashPass;
        $user->save();
        return $this->login($request);
    }

    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success'=>true,
                'message'=>'logout sukses'
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'success'=> false,
                'message'=> ''.$e
            ]);
        }
    }
}
