<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBatches extends Model
{
    protected $table = 'transaction_batches';

    protected $fillable = [
        'invoice', 'paid_amount', 'payment_method', 'deadline', 'type', 'status'
    ];

    use HasFactory;
}
