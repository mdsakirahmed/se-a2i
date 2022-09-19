<?php

use App\Http\Livewire\Backup;
use App\Http\Livewire\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\RolePermission;
use App\Http\Livewire\User;
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
        Route::view('women-and-children', 'backend.social-protection.women-and-children')->name('women-and-children');
        Route::view('food-insecurity', 'backend.social-protection.food-insecurity')->name('food_insecurity');
        Route::view('budget-and-coverage', 'backend.social-protection.budget-and-coverage')->name('budget_and_coverage');
        Route::view('poverty-and-inequality', 'backend.social-protection.poverty-and-inequality')->name('poverty-and-inequality');
    });

    //Health
    Route::group(['prefix' => 'health', 'as' => 'health.'], function () {
        Route::view('child-mortality', 'backend.health.child-mortality')->name('child-mortality');
        Route::view('causes-of-death', 'backend.health.causes-of-death')->name('causes-of-death');
        Route::view('maternal-and-child-health-service', 'backend.health.maternal-and-child-health-service')->name('maternal-and-child-health-service');
        Route::view('sdg-analytic-hub', 'backend.health.sdg-analytic-hub')->name('sdg-analytic-hub');
        Route::view('sdg-analytic-hub/heatmap', 'backend.health.sdg-analytic-hub.heatmap')->name('heatmap');
        Route::view('sdg-analytic-hub/extrapolation', 'backend.health.sdg-analytic-hub.extrapolation')->name('extrapolation');
        Route::view('sdg-analytic-hub/correlation-and-association', 'backend.health.sdg-analytic-hub.correlation-and-association')->name('correlation-and-association');
    });

    Route::get('backup', Backup::class)->name('backup');
    Route::get('role-permission', RolePermission::class)->name('role_permission')->middleware(['can:role permission management']);
    Route::get('user-management', User::class)->name('user_management')->middleware(['can:user management']);
    Route::get('profile', Profile::class)->name('profile');
});
