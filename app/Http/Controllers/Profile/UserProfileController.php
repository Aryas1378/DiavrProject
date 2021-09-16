<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show()
    {
        return auth()->user();
    }

    public function update(UserUpdateProfileRequest $request, User $user)
    {
        try {
            $user->update($request->only('name', 'email', 'password', 'profile_picture_url'));
            return $user;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
