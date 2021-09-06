<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeDefaultValuesStoreRequest;
use App\Http\Resources\AttributeDefaultValueResource;
use App\Models\AttributeDefaultValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeDefaultValuesController extends Controller
{

    public function index()
    {
        return AttributeDefaultValue::all();
    }

    public function show(AttributeDefaultValue $attributeDefaultValue)
    {
        return $attributeDefaultValue;
    }

    public function store(AttributeDefaultValuesStoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $attribute_default_value = AttributeDefaultValue::query()
                ->create($request
                ->only('attribute_id', 'values'));
            DB::commit();
            return $this->success(new AttributeDefaultValueResource($attribute_default_value));

        }catch (\Throwable $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function update(AttributeDefaultValuesStoreRequest $request, AttributeDefaultValue $attributeDefaultValue)
    {
        DB::beginTransaction();
        try {
            $attributeDefaultValue->update($request->only('attribute_id', 'value'));
            DB::commit();
            return $this->success("Done!");
        }catch (\Throwable $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function destroy(AttributeDefaultValue $attributeDefaultValue)
    {
        DB::beginTransaction();
        try {
            $attributeDefaultValue->delete();
            DB::commit();
            return $this->success("Done!");
        }catch (\Throwable $exception){
            DB::rollBack();
        }
    }
}
