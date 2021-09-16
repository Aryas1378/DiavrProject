<?php

namespace App\Http\Controllers\Site;

use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Routing\Controller;

class AdController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $ads = $user->ads()->where('status_id', '=', Ad::accepted)->get();
        return $this->success(AdResource::collection($ads));
    }

    public function show(Ad $ad)
    {
        return $this->success(new AdResource($ad));
    }


}
