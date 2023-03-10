<?php

use App\Http\Livewire\Testt;
use App\Http\Livewire\UserTable;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Users\Dashboard;
use App\Http\Livewire\Users\Auth\Login;
use App\Http\Livewire\Users\Auth\Reset;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;

use App\Http\Livewire\Users\Auth\Forget;
use App\Http\Controllers\User\UserController;
use App\Http\Livewire\Users\Fee\Index as FeeIndex;
use App\Http\Livewire\Users\Log\Index as LogIndex;
use App\Http\Livewire\Users\Users\Index as UserIndex;
use App\Http\Livewire\Users\Residents\Index as ResidentIndex;
use App\Http\Livewire\Users\Syndicates\Index as SyndicateIndex;
use App\Http\Livewire\Users\Bankaccounts\Index as AccountIndex;

use App\Http\Controllers\User\Auth\AuthController as UserAuthController;
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// use Session;
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
Route::middleware(['auth'])->get('/')->name('home');

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/forget', Forget::class)->name('password.forget');
        Route::get('/reset/{token}', Reset::class)->name('password.reset');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');

        // Users
        Route::get('/users/{type?}/{id?}', UserIndex::class)->name('users');

        // Residents
        Route::get('/residents/{type?}/{id?}', ResidentIndex::class)->name('residents');

        // Syndicate
        Route::get('/syndicates/{type?}/{id?}', SyndicateIndex::class)->name('syndicates');

        // Fee
        Route::get('/fees/{type?}/{id?}', FeeIndex::class)->name('fees');

        // Bank Accounts
        Route::get('/accounts/{type?}/{id?}', AccountIndex::class)->name('accounts');

        // Logs
        Route::get('/logs', LogIndex::class)->name('logs');


        Route::get('/logout', function(){
            auth()->logout();
            Session::flash('success', 'You Logged Out');
            return redirect()->route('user.login');
        })->name('logout');
    });

});
