<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CheckAuthRequest;
use App\Http\Requests\LoginRequest;

class CheckController extends Controller
{
    public function register(CheckAuthRequest $request){

        $request->validated($request->all());

        $data=Check::create([
            'u_name'=>$request->u_name,
            'email'=>$request->email,
            'dob'=>$request->dob,
            'password'=>Hash::make($request->password)
        ]
        );

        return response()->json(
            [
                'Status'=>1,
                'Message'=>'Registered Successfully',
                'token'=>$data->createToken('API Tokens'.$data->email)->plainTextToken,
            ]
        );
    }

    public function login(LoginRequest $request){
        $authenticated = $request->validated();
        $user = Check::where('email',$request->email)->first();
        /* if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(
                [
                    'Status'=>0,
                    'Message'=>'Invalid credentials'
                ]
            );
        }
        return response()->json(
            [
                'Status'=>1,
                'Message'=>'Login successfully',
                'token'=>$user->createToken('API Token'.$user->email)->plainTextToken
            ]
        ); */


        if(Hash::check($request->password,$user->password )&& ($user->email==$request->email)){
            return response()->json(
            [
                'Status'=>1,
                'Message'=>'Login successfully',
                'token'=>$user->createToken('API Token'.$user->email)->plainTextToken
            ]
        );
        }

        else{
            return response()->json(
                [
                    'Status'=>0,
                    'Message'=>'Invalid credentials'
                ]
            );
        }
    }
    public function logout(){
        Auth::user()->currentAccessToken()->delete();

        return response()->json(
            [
                'status'=>1,
                'Message'=>'Loggedd out successfully'
            ]
        );
    }
}
