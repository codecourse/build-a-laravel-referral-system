<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralIndexController;
use App\Http\Controllers\ReferralsDashboardController;
use App\Http\Controllers\ReferralStoreController;
use App\Http\Middleware\RedirectIfNoReferralCode;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/referral/{referralCode:code}', ReferralIndexController::class)->name('referral.index');
Route::post('/referral/{referralCode:code}', ReferralStoreController::class)->name('referral.store');

Route::middleware('auth')->group(function () {
    Route::get('/checkout/{plan:slug}', CheckoutController::class)->name('checkout.index');
    Route::get('/referrals', ReferralsDashboardController::class)->middleware(RedirectIfNoReferralCode::class)->name('referrals.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
