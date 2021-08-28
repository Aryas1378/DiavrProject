<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdStoreRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    public function index()
    {

//        return response()->json([
//            'data' => Ad::query()->with('category', 'attributeValues.attribute', 'city');
//        ]);

//        return $this->success(AdResource::collection(Ad::query()->with('city')));
//        return $this->success(new AdResource(Ad::query()->with('city')));
        return $this->success(new AdResource(Ad::query()->with('city')));

    }

    public function show(Ad $ad)
    {
        return $ad->load('category', 'attributeValues.attribute');
    }

    public function store(AdStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var Ad $ad */
            $ad = Ad::query()->create($request->only('category_id', 'title', 'description'));

            foreach ($request->get('attributes') as $attribute) {
                $ad->attributeValues()->create($attribute);
            }

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            dd($exception);
        }

        return response()->json([
            'data' => "ad created",
        ]);
    }

    public function update(AdUpdateRequest $request, Ad $ad)
    {

        DB::beginTransaction();
        try {

            /** @var Ad $ad */
            $ad->update($request->only('title', 'category_id'));

            $attributes = $ad->attributeValues()->delete();

            foreach ($request->get('attributes') as $attribute) {
                $ad->attributeValues()->create($attribute);
            }

            DB::commit();

            return $attributes;

        } catch (\Throwable $exception) {

            DB::rollBack();
            dd($exception);

        }

    }

    public function destroy(Ad $ad)
    {
        if ($ad->attributeValues()->count())

            $ad->attributeValues()->delete();

        $ad->delete();

        return [
            "error" => false,
            "message" => "ad was deleted!"
        ];
    }
}
