<?php

namespace App\Http\Controllers\Galaxy\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Request $request) {
        return view('galaxy.invoice.payment');
    }

    public function store() {
        dd('cool');
    }
}
