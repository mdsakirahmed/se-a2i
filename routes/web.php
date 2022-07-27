<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Backend\About;
use App\Http\Livewire\Backend\Education;
use Illuminate\Support\Facades\Route;

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


//Landing page
Route::get('/', function () {
    return redirect()->route('login');
});

//Authentication
Route::get('login', Login::class)->name('login')->middleware('guest');

//Backend route
Route::group(['middleware' => 'auth', 'prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::get('about', About::class)->name('about');
    Route::get('education', Education::class)->name('education');
});
