<?php

Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index'])->name('admin.index');
    Route::group(['prefix' => 'categories'], function (){
        Route::get('/', [\App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
        Route::get('create', [\App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
        Route::post('store', [\App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
        Route::delete('delete/{cat_id}', [\App\Http\Controllers\CategoryController::class,'delete'])->name('category.delete');
        Route::get('edit/{cat_id}', [\App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
        Route::put('update/{cat_id}', [\App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
    });
    Route::group(['prefix' => 'resources'], function (){
        Route::get('/', [\App\Http\Controllers\ContentController::class,'index'])->name('admin.resource.index');
        Route::get('create', [\App\Http\Controllers\ContentController::class,'create'])->name('admin.resource.create');
        Route::post('upload', [\App\Http\Controllers\ContentController::class,'upload'])->name('admin.resources.upload');
        Route::post('store', [\App\Http\Controllers\ContentController::class,'store'])->name('admin.resource.store');
        Route::delete('delete/{cat_id}', [\App\Http\Controllers\ContentController::class,'delete'])->name('admin.resource.delete');
        Route::get('edit/{cat_id}', [\App\Http\Controllers\ContentController::class,'edit'])->name('admin.resource.edit');
        Route::get('view/{cat_id}', [\App\Http\Controllers\ContentController::class,'view'])->name('admin.resource.show');
        Route::put('update/{cat_id}', [\App\Http\Controllers\ContentController::class,'update'])->name('admin.resource.update');
    });
});
