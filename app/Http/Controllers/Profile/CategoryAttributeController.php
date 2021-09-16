<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    public function show(Category $category)
    {
        return $this->success(
            new CategoryResource($category->load('attributes', 'attributes.defaultValues'))
        );
    }
}
