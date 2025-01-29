<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function checkout(Request $request) {
        return view('payments.checkout', [
            'name' => $request->query('name'),
            'price' => $request->query('price'),
            'location' => $request->query('location')
        ]);
    }
}
