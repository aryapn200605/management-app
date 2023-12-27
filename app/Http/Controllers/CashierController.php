<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\Transaction;
use App\Models\TransactionBatches;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('admin.cashier.index');
    }

    public function transaction(Request $request)
    {
        // dd($request);
        $request->validate([
            'customer'      => 'required',
            'invoice'       => 'required',
            'phone'         => 'required',
            'date'          => 'required',
            'product_id'    => 'required',
            'qty'           => 'required',
            'price'         => 'required',
            'total'         => 'required',
            'note'          => 'required',
            'deadline'      => 'required',
            'grand_total'   => 'required',
            'deposits'      => 'required',
            'paid_amount'   => 'required',
            'payment_method'=> 'required',
        ]);

        // echo "<pre>";print_r($request->total);die;

        if ($request->customer_id) {
            $customer = CustomerModel::find($request->customer_id);
        
            if ($customer) {
                $customer->transaction_total += 1;
                $customer->save();
            }
        } else {
            $customer = new CustomerModel();
        
            $customer->name = $request->input('customer');
            $customer->phone = $request->input('phone');
            $customer->address = "none";
            $customer->transaction_total = 1;
        
            $customer->save();
        }

        $batch = new TransactionBatches();

        $batch->invoice = $request->invoice;
        $batch->paid_amount = $request->paid_amount;
        $batch->payment_method = $request->payment_method;
        $batch->note = $request->note;
        $batch->deadline = $request->deadline;
        $batch->customer_id = $customer->id;
        $batch->type = 1;

        if ($request->paid_amount == 0) {
            $batch->status = 1;
        } else {
            $batch->status = 0;
        }
        
        $batch->save();
        $array = [];
        foreach ($request->product_id as $i => $product) {
            $transaction = new Transaction();

            $transaction->qty = $request->qty[$i];
            $transaction->unit_price = $request->price[$i];
            $transaction->total_price = $request->total[$i];
            $transaction->product_id = $request->product_id[$i];
            $transaction->batch_id = $request->invoice;

            $transaction->save();
            $array[] = $transaction;
        }

        return redirect()->route('cashier')->with('success', 'Berhasil menambah pesanan');
    }
}
