<?php

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [\App\Http\Controllers\DashboardController::class,'index'])->name('admin.index');
    Route::group(['prefix' => 'categories'], function (){
        Route::get('/', [\App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
        Route::get('create', [\App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
        Route::post('store', [\App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
        Route::delete('delete/{cat_id}', [\App\Http\Controllers\CategoryController::class,'delete'])->name('category.delete');
        Route::get('edit/{cat_id}', [\App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
        Route::put('update/{cat_id}', [\App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
    });
});
