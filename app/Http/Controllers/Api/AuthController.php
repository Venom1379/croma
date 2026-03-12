<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$request->email)
                    ->where('role',0)
                    ->first();

        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'Supervisor not found'
            ],404);
        }

        if(!Hash::check($request->password,$user->password)){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid password'
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status'=>true,
            'message'=>'Login successful',
            'token'=>$token,
            'user'=>$user
        ]);
    }


    public function profile(Request $request)
    {
        return response()->json([
            'status'=>true,
            'data'=>$request->user()
        ]);
    }
}