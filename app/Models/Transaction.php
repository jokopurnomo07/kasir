<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    use HasFactory;

    public function tr_detail()
    {
        return $this->hasMany(TransactionDetails::class, 'transactions_id', 'id');
    }
}
