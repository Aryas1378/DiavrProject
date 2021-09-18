<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;

class AdminAttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }

    public function show(Attribute $attribute)
    {
        return $this->success(new AttributeResource($attribute));
    }
}
