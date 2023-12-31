<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'name', 'phone', 'address', 'transaction_total'
    ];

    use HasFactory;
}
