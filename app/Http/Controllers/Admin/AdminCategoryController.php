<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStroreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\AttributeCategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminCategoryController extends Controller
{

    public function index()
    {
//        $categories = Category::query()->with('parent', 'ad', 'children', 'attributes', 'city')->get();
        $categories = Category::query()->with('children', 'city', 'ads')->get();
//        $categories = Category::query()->with('ad')->get();
//        Log::info($categories);
//        return $this->success(CategoryResource::collection($categories));
        return $this->success(CategoryResource::collection($categories));
    }

    public function show(Category $category)
    {

        return $this->success(
            new CategoryResource($category->load('children', 'parent', 'city', 'attributes'))
        );

    }

    public function store(CategoryStroreRequest $request)
    {

        $category = Category::query()->create($request->only('name', 'parent_id'));
        return $this->success(new CategoryResource($category));

    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {

        DB::beginTransaction();

        try {

            $category->update($request->only('name', 'parent_id'));

            DB::commit();

            return $this->success(new CategoryResource($category));

        } catch (\Throwable $exception) {

            DB::rollBack();

            dd($exception);

        }

    }

    public function destroy(Category $category)
    {

        if ($category->children()->count()) {
            return $this->error("category has children");
        }

        if (AttributeCategory::query()->where('category_id', $category->id)->count()) {

            return $this->error("category is on use");
        }

        $category->delete();
        return $this->success("Category is deleted");

    }

}
