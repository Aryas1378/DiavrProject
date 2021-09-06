<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Support\Facades\Log;

class AdminAdController extends Controller
{

    public function index()
    {
        $ads = Ad::query()->with('category', 'city', 'attributes')->get();
        return $this->success(AdResource::collection($ads));
    }

    

}
