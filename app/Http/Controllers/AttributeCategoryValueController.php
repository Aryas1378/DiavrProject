<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use App\Models\AttributeValue;

class AttributeCategoryValueController extends Controller
{
    public function index()
    {
        return AttributeValue::with('values')->get();
    }

    public function category_id()
    {
        return AttributeValue::with('attribute_category')->get();
    }

    public function get_value_detail()
    {
        return AttributeValue::with('value_detail')->get();
    }

    public function get_ad_detail()
    {
        return AttributeValue::with('ad_detail')->get();
    }

    public function show(Ad $ad)
    {
        return Ad::with('get_ad')->where('id', $ad->id)->get();
    }

}
