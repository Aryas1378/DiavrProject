<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class AttributeController extends Controller
{

    public function index($category)
    {
        /** @var Category $category_list */
        $attribute_list = collect([]);
        $category_list = AttributeCategory::query()->where('category_id', $category)->get();
        foreach ($category_list as $item)
            {
                $attribute_list->push(Attribute::query()->where('id', $item->attribute_id)->get());
            }
        return $attribute_list->all();
    }

}
