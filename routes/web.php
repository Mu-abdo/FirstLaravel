<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\FatoraController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify'=>true]);


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home') ->middleware('verified');

    Route::get('/',[FatoraController::class, 'index'])->middleware('auth');

    Route::get('fillup', [CrudController::class, 'getOffers']);

    Route::group(['prefix' => 'offers'], function(){
        Route::get('create', [CrudController::class, 'createOffer']);
        Route::post('store', [CrudController::class, 'store'])->name('offers.store');

        });
    Route::get('alloffers', [CrudController::class, 'getOfferAll']);

});
