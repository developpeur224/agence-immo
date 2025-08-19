<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController as PropertyControllerAlias;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'doLogout'])->name('auth.doLogout');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/property')->name('property.')->controller(PropertyControllerAlias::class)->group(function() {
    Route::get('/biens', 'index')->name('index');
    Route::get('/bien/{property}', 'show')->name('show');
    Route::post('/bien/{property}/contact', 'contact')->name('contact');
});

Route::prefix('admin')->middleware('auth')->name('admin.') ->group(function () {
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);

});
