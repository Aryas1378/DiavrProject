<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {

        /** @var User $user */
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'profile_picture_url' => $request['profile_picture_url'],

        ]);
        return $this->success([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);

    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);
        if(Auth::attempt(['name' => $fields['name'], 'password' => $fields['password']])){
            $user = auth()->user();
            return $this->success([
                'token' => $user->createToken('tokens')->plainTextToken
            ]);
        }else{
            return $this->error("The provided credentials are incorrect.");
        }
    }

//    public function me(Request $request)
//    {
//        return $request->user();
//    }

}
