<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeDefaultValuesStoreRequest;
use App\Http\Requests\AttributeDefaultValuesUpdateRequest;
use App\Http\Resources\AttributeDefaultValueResource;
use App\Models\Attribute;
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
            foreach ($request->values as $value) {
                AttributeDefaultValue::create([
                    'attribute_id' => $request->attribute_id,
                    'value' => $value,
                ]);
            }
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function update(AttributeDefaultValuesUpdateRequest $request, AttributeDefaultValue $attributeDefaultValue)
    {
            $attributeDefaultValue->update($request->only('value'));
            return $this->success("done");
    }

    public function destroy(AttributeDefaultValue $attributeDefaultValue)
    {
        DB::beginTransaction();
        try {
            $attributeDefaultValue->delete();
            DB::commit();
            return $this->success("Done!");
        } catch (\Throwable $exception) {
            DB::rollBack();
        }
    }
}
