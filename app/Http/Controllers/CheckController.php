<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CheckAuthRequest;

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
}
