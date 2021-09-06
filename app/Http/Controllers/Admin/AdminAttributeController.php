<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;

class AdminAttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }

    public function show(Attribute $attribute)
    {
        return $attribute;
    }
}
