<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Galaxy\Invoice\PaymentController;  

/*
|--------------------------------------------------------------------------
| Payments Routes
|--------------------------------------------------------------------------
|
|
*/

Route::middleware(['auth'])->prefix('payment')->as('payment.')->group(function() {

    Route::get('/{payment_invoice_token}', [PaymentController::class, 'create'])->name('create');
    Route::post('/{payment_invoice_token}', [PaymentController::class, 'store'])->name('store');
    
});

Route::middleware(['auth'])->prefix('invoice')->as('invoice.')->group(function() {

    Route::get('/{payment_invoice_token}', [PaymentController::class, 'create'])->name('view');
    
});
