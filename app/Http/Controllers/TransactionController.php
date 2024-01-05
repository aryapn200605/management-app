<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionBatches;
use Exception;
use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

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

        // dd($datas);

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

        $transactions = Transaction::where('batch_id', $batch->invoice)->get();
        $total = $transactions->sum('total_price');

        $data = [
            'batch' => $batch,
            'trx'   => $transactions,
            'total' => $total,
        ];

        return response()->json($data);
    }

    public function cancellation(String $id)
    {
        $trx = TransactionBatches::find($id);

        if ($trx) {
            $trx->type = 3;
            $trx->save();
            return response('Success cancel the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }

    public function finishOrder(String $id)
    {
        $trx = TransactionBatches::find($id);

        if ($trx) {
            $trx->type = 2;
            $trx->save();
            return response('Success finish the transaction', 200);
        } else {
            return response('Transaction not found', 404);
        }
    }
}
