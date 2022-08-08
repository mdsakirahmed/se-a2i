<?php

use App\Http\Livewire\Backup;
use App\Http\Livewire\Login;
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
    Route::view('about', 'backend.about')->name('about');
    Route::view('education', 'backend.education')->name('education');

    //Economy
    Route::group(['prefix' => 'economy', 'as' => 'economy.'], function () {
        Route::view('overview-of-the-economy', 'backend.economy.overview-of-the-economy')->name('overview_of_the_economy');
        Route::view('overseas-employment-and-remittance', 'backend.economy.overseas-employment-and-remittance')->name('overseas_employment_and_remittance');
        Route::view('import-export', 'backend.economy.import-export')->name('import_export');
        Route::view('banking-and-finance', 'backend.economy.banking-and-finance')->name('banking_and_finance');
    });

    //Social Protection
    Route::group(['prefix' => 'social-protection', 'as' => 'social_protection.'], function () {
        Route::view('/', 'backend.social-protection.social-protection')->name('index');
        Route::view('food-security', 'backend.social-protection.food-security')->name('food_security');
        Route::view('social-protection', 'backend.social-protection.budget-and-coverage')->name('budget_and_coverage');
    });

    Route::get('backup', Backup::class)->name('backup');
});
