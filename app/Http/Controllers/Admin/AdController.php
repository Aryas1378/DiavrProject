<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdUpdateRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{


    public function index()
    {
        $categories = Ad::query()
            ->with('category', 'city', 'attributes', 'status')
            ->get();

        return $this->success(AdResource::collection($categories));
    }

    public function show(Ad $ad)
    {
        return $this->success(
            new AdResource(
                $ad->load('category', 'city', 'attributes', 'status')
            )
        );
    }

    public function update(AdUpdateRequest $request, Ad $ad)
    {

        DB::beginTransaction();
        try {

            $ad->update($request->only('status_id'));
            DB::commit();
            return $this->success(new AdResource($ad));

        } catch (\Throwable $exception) {

            DB::rollBack();
            dd($exception->getMessage());

        }

    }

    public function destroy(Ad $ad)
    {

        if ($ad->category()->count()) {
            return $this->error("category has children");
        }

        $ad->delete();
        return $this->success("Category is deleted");

    }

}
