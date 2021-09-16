<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeStoreRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index()
    {
        return $this->success(AttributeResource::collection(Attribute::all()));
    }

    public function show(Attribute $attribute)
    {
        return $this->success(
            new AttributeResource($attribute->load('categories')) // todo : additional
        );
    }

    public function store(AttributeStoreRequest $request)
    {
        $attribute = Attribute::query()->create($request->get('name'));
        return $this->success(new AttributeResource($attribute));
    }

    public function update(AttributeStoreRequest $request, Attribute $attribute)
    {
        DB::beginTransaction();
        try {
            $attribute->update($request->only('name'));
            DB::commit();
            return $this->success(new AttributeResource($attribute));
        }catch (\Throwable $exception){
            DB::rollBack();
            return $this->error($exception->getMessage());
        }
    }

    public function destroy(Attribute $attribute)
    {

        if ($attribute->value()->count())
        {
            return "attribute is used on value table";
        }
        if ($attribute->ads()->count())
        {
            return "attribute is used on ads table";
        }
        if ($attribute->categories()->count())
        {
            return "attribute is used on categories table";
        }
        $attribute->delete();
        $this->success("attribute is deleted");

    }

}
