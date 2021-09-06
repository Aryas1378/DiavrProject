<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteAdStoreRequest;
use App\Http\Resources\SiteAdResource;
use App\Models\Ad;

class AdController extends Controller
{
    public function index()
    {

        $ads = Ad::query()->with('city', 'category', 'attributes')->get();
        return $this->success(SiteAdResource::collection($ads));

    }

    public function show(Ad $ad)
    {

        return $this->success(new SiteAdResource($ad
            ->load('city', 'category','attributes')));

    }

    public function store(SiteAdStoreRequest $request)
    {
        $ad = Ad::query()->create($request->only('title', 'city_id', 'category_id', 'attributes'));
        return $this->success(new SiteAdResource($ad));
    }

}
