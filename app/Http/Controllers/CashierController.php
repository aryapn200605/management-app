<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('admin.cashier.index');
    }

    public function transaction(Request $request)
    {
        echo '<pre>';
        print_r($request);
        die;
    }
}
