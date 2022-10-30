<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class APIUserController extends BaseController
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()){
            return $this->sendError('Validation Failed', ['error' => $validator->messages()]);
        }

        if (Auth::attempt($request->only('email', 'password'))){
            $token = Str::random(60);
            $user = Auth::user();
            $user->fill([ 'token' => $token])->save();
            $user->token = $token;
            return $user;
        }else{
            return $this->sendError("Invalid Login Credentials");
        }
    }
}
