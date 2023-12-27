<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionBatches;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $batches = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->orderBy('status', 'asc');

        $status = $request->query('status');
        $type = $request->query('type');

        if ($status == 'lunas') {
            $batches->where('transaction_batches.status', 1);
        } else if ($status == 'belum-lunas') {
            $batches->where('transaction_batches.status', 0);
        }
        
        if ($type == 'proses') {
            $batches->where('transaction_batches.type', 1);
        } else if ($type == 'selesai') {
            $batches->where('transaction_batches.type', 2);
        } else if ($type == 'batal') {
            $batches->where('transaction_batches.type', 3);
        }

        $batches = $batches->get();

        $datas = [];

        foreach ($batches as $batch) {
            $transactions = Transaction::where('batch_id', $batch->invoice)->get();

            $total = $transactions->sum('total_price');

            $datas[] = [
                'batch' => $batch,
                'trx'   => $transactions,
                'total' => $total,
            ];
        }

        return view('admin.transactions.index', ['datas' => $datas, 'type' => $type, 'status' => $status]);
    }

    public function findOne(String $id)
    {
        $batch = TransactionBatches::join('customer', 'transaction_batches.customer_id', '=', 'customer.id')
            ->where('transaction_batches.invoice', $id)
            ->first();


        if (!$batch) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        $transactions = Transaction::where('batch_id', $batch->invoice)
            ->join('products', 'transaction.product_id', '=', 'products.id')
            ->get();
        $total = $transactions->sum('total_price');

        $data = [
            'batch' => $batch,
            'trx'   => $transactions,
            'total' => $total,
        ];

        return response()->json($data);
    }
}
