<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStroreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\AttributeCategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{

    public function index()
    {

        // set pagination

        $categories = Category::query()->whereNull('parent_id')->paginate(1);

        return $this->success(new CategoryCollection($categories));

        //Done

    }

    public function show(Category $category)
    {
        // todo return all children in resource

        return $this->success(
            new CategoryResource($category->load('children'))
        );

        //Done

    }

    public function store(CategoryStroreRequest $request)
    {

        // todo set validation

        $category = Category::query()->create($request->only('name', 'parent_id'));

        return $this->success(new CategoryResource($category));

        //Done
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        //Todo returning as resource //Done

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

    public function parents(Category $category)
    {

        $response = $category->load('parent.parent');
        return $this->success(new ParentResource($response));

    }

    public function destroy(Category $category)
    {
        //Todo returning in resource and validate

        if ($category->children()->count()) {
            return $this->error("category has children");
        }

        if (AttributeCategory::query()->where('category_id', $category->id)->count()) {

            return $this->error("category is on use");
        }

        $category->delete();

        return $this->success("Category is deleted");

        //Done
    }
}
