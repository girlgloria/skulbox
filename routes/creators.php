<?php

Route::group(['middleware' => ['creator','user-category']], function (){
    Route::group(['prefix' => 'creator'], function(){
        Route::group(['prefix' => 'requests'], function (){
            Route::get('/', [\App\Http\Controllers\RequestController::class,'creatorRequests'])
                ->name('creator.requests');
            Route::get('/{request_id}/show', [\App\Http\Controllers\RequestController::class,'viewRequest'])
                ->name('creator.requests.show');
            Route::post('/{request_id}/place-bid', [\App\Http\Controllers\RequestOfferController::class,'placeBid'])
                ->name('creator.requests.bid');
        });
        Route::group(['prefix' => 'bids'], function (){
            Route::get('/', [\App\Http\Controllers\RequestOfferController::class,'creatorBids'])
                ->name('bids.index');
            Route::get('/bid/action', [\App\Http\Controllers\RequestOfferController::class,'creatorBidAction'])
                ->name('bids.action');
            Route::get('/{request_id}/show', [\App\Http\Controllers\RequestController::class,'viewRequest'])
                ->name('creator.requests.show');
            Route::post('/{request_id}/place-bid', [\App\Http\Controllers\RequestOfferController::class,'placeBid'])
                ->name('creator.requests.bid');
        });
        Route::group(['prefix' => 'resources'], function (){
            Route::get('/', [\App\Http\Controllers\ContentController::class,'index'])->name('resource.index');
            Route::get('create', [\App\Http\Controllers\ContentController::class,'create'])->name('resource.create');
            Route::post('upload', [\App\Http\Controllers\ContentController::class,'upload'])->name('resources.upload');
            Route::post('store', [\App\Http\Controllers\ContentController::class,'store'])->name('resource.store');
            Route::delete('delete/{cat_id}', [\App\Http\Controllers\ContentController::class,'delete'])->name('resource.delete');
            Route::get('edit/{cat_id}', [\App\Http\Controllers\ContentController::class,'edit'])->name('resource.edit');
            Route::get('view/{cat_id}', [\App\Http\Controllers\ContentController::class,'view'])->name('resource.show');
            Route::put('update/{cat_id}', [\App\Http\Controllers\ContentController::class,'update'])->name('resource.update');
        });
    });
});

Route::get('creators/register', [\App\Http\Controllers\CreatorController::class, 'register'])->name('creator.register');
Route::group(['middleware' => 'auth'], function (){
    Route::get('choose/categories', [\App\Http\Controllers\CreatorController::class, 'chooseCategories'])->name('creator.categories');
    Route::post('choose/categories', [\App\Http\Controllers\CreatorController::class, 'storeChoices'])->name('creator.choices.store');
});
