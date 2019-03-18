<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/resources', [\App\Http\Controllers\ContentController::class,'explore'])->name('explore.index');
    Route::get('my/resources', 'ContentController@myResources')->name('resources.my');
    Route::get('/search/resources', 'ContentController@search')->name('resources.search');
    Route::get('/creators', 'ContentController@creators')->name('explore.creators');
    Route::get('/download/{content}', 'ContentController@download')->name('content.download');
    Route::get('/download/request-file/{request}', 'ContentController@downloadRequest')->name('content.download.request');
    Route::get('/content/show/{content}', 'ContentController@show')->name('content.show');
    Route::post('/content/purchase/{content}', 'ContentController@purchase')->name('content.purchase');
    Route::get('/order/content', 'ContentController@orderContent')->name('order.content');
    Route::get('/upload/content', 'ContentController@uploadContent')->name('upload.content');
    Route::post('/upload/content', 'ContentController@store')->name('upload.content.store');
    Route::post('/order/content', 'ContentController@orderRequest')->name('order.request');
    Route::get('/my/orders', 'RequestController@myRequests')->name('orders.my');
    Route::get('/orders/{order_id}/bids', 'RequestController@orderBids')->name('orders.bids');
    Route::get('/bids/{bid_id}/accept', 'RequestOfferController@bidAccepted')->name('bids.accept');
    Route::get('/{request_id}/order', 'RequestController@viewOrder')->name('order.view');
    Route::post('/order/payment', 'ContentController@orderPayment')->name('order.payment');
    Route::post('/report/content', 'ContentController@reportContent')->name('report.content');
    Route::post('/report/content', 'ContentController@reportContent')->name('report.content');
    //group
    Route::get('@{group}/group', [\App\Http\Controllers\GroupController::class,'viewGroup'])->name('group.group');
    Route::get('my/groups', [\App\Http\Controllers\GroupController::class,'myGroup'])->name('group.my');
    Route::get('groups/create', [\App\Http\Controllers\GroupController::class,'create'])->name('group.create');
    Route::post('groups/store', [\App\Http\Controllers\GroupController::class,'store'])->name('group.store');
    Route::post('groups/share', [\App\Http\Controllers\GroupController::class,'share'])->name('group.share');
});

//Admin
Route::group([], base_path('routes/admin.php'));
//creator
Route::group([], base_path('routes/creators.php'));
