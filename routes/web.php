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

use App\Http\Livewire\Users\Contracts\Index as ContractIndex;
use App\Http\Livewire\Users\Fees\Index as FeeIndex;
use App\Http\Livewire\Users\Log\Index as LogIndex;
use App\Http\Livewire\Users\Users\Index as UserIndex;
use App\Http\Livewire\Users\Residents\Index as ResidentIndex;
use App\Http\Livewire\Users\Documents\Index as DocumentIndex;
use App\Http\Livewire\Users\Bankaccounts\Index as AccountIndex;
use App\Http\Livewire\Users\Syndicates\Index as SyndicateIndex;
use App\Http\Livewire\Users\Charges\Index as ChargeIndex;
use App\Http\Livewire\Users\Cashes\Index as CasheIndex;
use App\Http\Livewire\Users\CompanyCharges\Index as CompanyChargesIndex;

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
Route::get('/test',[TestController::class, 'pdf'])->name('test');
Route::middleware(['auth'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
});

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/login', Login::class)->name('login');
        Route::get('/forget', Forget::class)->name('password.forget');
        Route::get('/reset/{token}', Reset::class)->name('password.reset');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');

        // Users
        Route::get('/users/{type?}/{id?}', UserIndex::class)->name('users');

        // Syndicate
        Route::get('/syndicates/{type?}/{id?}', SyndicateIndex::class)->name('syndicates'); 
        Route::get('/syndicate/{syndicate_id}/residents/{type?}/{id?}', ResidentIndex::class)->name('syndicate.residents'); 
        Route::get('/syndicate/{syndicate_id}/documents/{type?}/{id?}', DocumentIndex::class)->name('syndicate.documents');
        Route::get('/syndicate/{syndicate_id}/fees/{type?}/{id?}', FeeIndex::class)->name('syndicate.fees');
        Route::get('/syndicate/{syndicate_id}/contracts', [ContractIndex::class,'pdf'])->name('syndicate.contract');

        // Bank Accounts
        Route::get('/accounts/{type?}/{id?}', AccountIndex::class)->name('accounts');
        
        // Charge
        Route::get('/charges/{type?}/{id?}', ChargeIndex::class)->name('charges');

        // Cashes
        Route::get('/cashes/{type?}/{id?}', CasheIndex::class)->name('cashes');
        
        // Company Charges
        Route::get('/company/charges/{type?}/{id?}', CompanyChargesIndex::class)->name('company.charges');

        // Logs
        Route::get('/logs', LogIndex::class)->name('logs');


        Route::get('/logout', function(){
            auth()->logout();
            Session::flash('success', 'You Logged Out');
            return redirect()->route('user.login');
        })->name('logout');
    });

});
