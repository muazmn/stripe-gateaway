<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Stripe;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('stripe', function () {
    return view('stripe');
});
Route::post('stripe', function (Request $request) {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    Stripe\Charge::create([
        "amount" => 100 * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Test payment from tutsmake.com."
    ]);

    session()->flash('success', 'Payment successful!');

    return back();
});
