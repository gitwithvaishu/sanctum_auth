<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DairyRegisterRequest;
use App\Http\Requests\DairyLoginRequest;

use App\Models\Dairy;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Traits\HttpResponses;



class DairyController extends Controller
{
    use HttpResponses;

    public function dregister(DairyRegisterRequest $request){
        $request->validated($request->all());

        $user=Dairy::create(
            [
                'email'=>$request->email,
                'name'=>$request->name,
                'dob'=>$request->dob,
                'password'=>Hash::make($request->password),
            ]
        );

        return $this->authSuccess([
            'User_data'=>$user,
            'Token'=>$user->createToken('Sanctum Token'.$user->email)->plainTextToken
        ],
        'Register Successfully',
    );
    }

    public function dlogin(DairyLoginRequest $request){
        $request->validated($request->all());
        $user=Dairy::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->authError(
                '',
                'Credientials doesnot match',
                401
            );

        }

        else{
            return $this->authSuccess([
                'User_data'=>$user,
                'Token'=>$user->createToken('Santum Token'.$user->email)->plainTextToken
            ],
            'Login Successfully',
            );
        }
    }

    public function dlogout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->authSuccess('','Logged Out Successfully',);
    }
}
