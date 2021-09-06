<?php

use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeDefaultValuesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Ad;
use App\Models\Attribute;
use App\Models\AttributeDefaultValue;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])
        ->middleware('can:viewAny,' . Category::class)
        ->name('admin.categories.index');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->middleware('can:view,category')
        ->name('admin.categories.show');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->middleware('can:create,' . Category::class)
        ->name('admin.categories.store');

    Route::patch('/categories/{category}', [CategoryController::class, 'update'])
        ->middleware('can:update,category')
        ->name('admin.categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->middleware('cane:delete,category')
        ->name('admin.categories.destroy');

    Route::get('attributes', [AttributeController::class, 'index'])
        ->middleware('can:viewAny,' . Attribute::class)
        ->name('admin.attributes.index');

    Route::get('attributes/{attribute}', [AttributeController::class, 'show'])
        ->middleware('can:view,attribute')
        ->name('admin.attribute.show');

    Route::post('attributes', [AttributeController::class, 'store'])
        ->middleware('can:create,' . Attribute::class)
        ->name('admin.attribute.store');

    Route::patch('attributes/{attribute}', [AttributeController::class, 'update'])
        ->middleware('can:update,attribute')
        ->name('admin.attributes.update');

    Route::delete('attributes/{attribute}', [AttributeController::class, 'destroy'])
        ->middleware('can:delete,attribute')
        ->name('admin.attributes.destroy');

    Route::get('attributes/default/values', [AttributeDefaultValuesController::class, 'index'])
        ->middleware('can:viewAny,' . AttributeDefaultValue::class)
        ->name('admin.attributeDefaultValues.index');

    Route::get('/attributes/default/values/{attributeDefaultValue}', [AttributeDefaultValuesController::class, 'show'])
        ->middleware('can:view,attributeDefaultValue')
        ->name('admin.attributeDefaultValues.show');

    Route::post('/attributes/default/values', [AttributeDefaultValuesController::class, 'store'])
        ->middleware('can:create,'.AttributeDefaultValue::class)
        ->name('admin.attributeDefaultValues.store');

    Route::patch('/attributes/default/values/{attributeDefaultValue}', [AttributeDefaultValuesController::class, 'update'])
        ->middleware('can:update,attributeDefaultValue')
        ->name('admin.attributeDefaultValues.update');

    Route::delete('/attributes/default/values/{attributeDefaultValue}', [AttributeDefaultValuesController::class, 'destroy'])
        ->middleware('can:delete,attributeDefaultValue')
        ->name('admin.attributeDefaultValues.destroy');

    Route::get('/ads', [AdController::class, 'index'])
        ->middleware('can:viewAny,' . Ad::class)
        ->name('admin.ads.index');

    Route::get('/ads/{ad}', [AdController::class, 'show'])
        ->middleware('can:view,ad')
        ->name('admin.ads.show');

    Route::patch('/ads/{ad}', [AdController::class, 'update'])
        ->middleware('can:update,ad')
        ->name('admin.ads.update');

    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])
        ->middleware('can:delete,ad')
        ->name('admin.ads.destroy');

    Route::post('/ads/get/{category}', [CategoryController::class, 'show'])
        ->middleware('can:view,category')
        ->name('admin.ads.category');

});
