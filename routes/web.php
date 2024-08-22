<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\SettingsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('paypal', [PaymentGatewayController::class, 'paypal'])->name('paypal');
Route::get('paypalsuccess', [PaymentGatewayController::class, 'paypalsuccess'])->name('paypalsuccess');
Route::get('paypalcancel', [PaymentGatewayController::class, 'paypalcancel'])->name('paypalcancel');

Route::post('razorpay', [PaymentGatewayController::class, 'razorpay'])->name('razorpay');
Route::get('razorpaysuccess', [PaymentGatewayController::class, 'razorpaysuccess'])->name('razorpaysuccess');
Route::get('razorpaycancel', [PaymentGatewayController::class, 'razorpaycancel'])->name('razorpaycancel');

Route::post('stripe', [PaymentGatewayController::class, 'stripe'])->name('stripe');
Route::get('stripesuccess', [PaymentGatewayController::class, 'stripesuccess'])->name('stripesuccess');
Route::get('stripecancel', [PaymentGatewayController::class, 'stripecancel'])->name('stripecancel');

Route::post('/phonepe/payment', [PaymentGatewayController::class, 'phonepe'])->name('phonepe');
Route::get('/phonepe/success', [PaymentGatewayController::class, 'phonepesuccess'])->name('phonepesuccess');
Route::get('/phonepe/cancel', [PaymentGatewayController::class, 'phonepecancel'])->name('phonepecancel');

Route::post('/icici/payment', [PaymentGatewayController::class, 'icici'])->name('icici');
Route::get('/icici/success', [PaymentGatewayController::class, 'icicisuccess'])->name('icicisuccess');
Route::get('/icici/cancel', [PaymentGatewayController::class, 'icicicancel'])->name('icicicancel');

Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('auth/facebook', [GoogleAuthController::class, 'redirectToFacebook'])->name('facebook-auth');
Route::get('auth/facebook/callback', [GoogleAuthController::class, 'callbackFacebook']);

Route::get('auth/instagram', [GoogleAuthController::class, 'redirectToInstagram'])->name('instagram-auth');
Route::get('auth/instagram/callback', [GoogleAuthController::class, 'callbackInstagram']);

Route::get('auth/twitter', [GoogleAuthController::class, 'redirectToTwitter'])->name('twitter-auth');
Route::get('auth/twitter/callback', [GoogleAuthController::class, 'callbackTwitter']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/payment/update', [SettingsController::class, 'updatePaymentSettings'])->name('settings.payment.update');
    Route::get('/settings/create', [SettingsController::class, 'create']);
    Route::post('settings', [SettingsController::class, 'storePaymentGateway'])->name('settings.store');
    Route::get('/settings/payment-gateway/{id}/edit', [SettingsController::class, 'editPaymentGateway'])->name('settings.payment_gateway.edit');
    Route::put('/settings/payment-gateway/{id}', [SettingsController::class, 'updatePaymentGateway'])->name('settings.payment_gateway.update');
    Route::get('payment-gateway/{id}', [SettingsController::class, 'destroyPaymentGateway'])->name('settings.payment_gateway.destroy');

});
 


Route::middleware(['auth'])->group(function () {
    Route::get('/users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    Route::resource('/users', App\Http\Controllers\UserController::class);

    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::resource('/roles', App\Http\Controllers\RoleController::class);
});



require __DIR__ . '/auth.php';
