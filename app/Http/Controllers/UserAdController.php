<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Models\User;

class UserAdController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $ads = $user->ads()->where('status_id', '=', 2)->get();
        return $this->success(AdResource::collection($ads));
    }

    public function show(Ad $ad)
    {
        return $this->success(new AdResource($ad));
    }

}
