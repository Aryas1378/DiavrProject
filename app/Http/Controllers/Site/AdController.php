<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteAdStoreRequest;
use App\Http\Requests\SiteAdUpdateRequest;
use App\Http\Resources\SiteAdResource;
use App\Models\Ad;
use PhpParser\Builder;

class AdController extends Controller
{
    public function index()
    {

        $ads = Ad::query();
        $ads->where('status_id', '=', 2);
        return $this->success(SiteAdResource::collection($ads
            ->with('city', 'category', 'attributes', 'pictures', 'status')
            ->get()));

    }

    public function show(Ad $ad)
    {

        return $this->success(new SiteAdResource($ad
            ->load('city', 'category', 'attributes')));

    }

    public function store(SiteAdStoreRequest $request)
    {

        /** @var Ad $ad */
        $ad = Ad::query()->create($request->only('title', 'city_id', 'category_id', 'user_id') + ['user_id' => auth()->user()->id]);

        try {
            foreach ($request->get('attributes') as $attribute) {
                $ad->attributes()->attach(
                    $attribute['attribute_id'],
                    [
                        'value' => $attribute['value']
                    ]
                );
            }
        } catch (\Exception $exception) {
            dump($exception);
        }
        return $this->success("Done");

    }

    public function update(SiteAdUpdateRequest $request, Ad $ad)
    {

        /** @var Ad $ad */
        try {
            $ad->update($request->only('title', 'description', 'city_id', 'category_id'));

            $ad->attributes()->sync($request->get('attributes'));
        } catch (\Exception $exception) {
            dump($exception);
        }
        return $this->success("Done");

    }

    public function destroy(Ad $ad)
    {
        try {
            $ad->delete();
            return $this->success("Done");
        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }

    }

}
