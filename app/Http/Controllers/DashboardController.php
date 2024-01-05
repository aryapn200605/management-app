<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\Transaction;
use App\Models\TransactionBatches;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_order = TransactionBatches::where('type', '1')->count();
        $customer = CustomerModel::count();

        $total_paid = TransactionBatches::where('type', '!=', '3')->sum('paid_amount');
        $not_canceled = TransactionBatches::where('type', '!=', '3')->pluck('invoice')->toArray();
        $total_omzet = Transaction::whereIn('batch_id', $not_canceled)->sum('total_price');
        $unpaid = TransactionBatches::where('type', 1)
            ->join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->orderby('deadline')->get();

        $datas = [
            'total_order'   => $total_order,
            'customer'      => $customer,
            'omzet'         => $total_omzet - $total_paid,
            'unpaid'        => $unpaid
        ];

        return view('admin.dashboards.index', compact('datas'));
    }
}
