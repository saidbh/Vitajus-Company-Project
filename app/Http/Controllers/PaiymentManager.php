<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiymentManager extends Controller
{
    /*here is methode that returns the m-payments views*/

    public function monthlyPay()
    {
        return view('items.m-payments.monthlypaiment');
    }

    public function chargesToPay()
    {
        return view('items.m-payments.chargestopay');
    }

    public function totalCharges()
    {
        return view('items.m-payments.total-charge');
    }
}
