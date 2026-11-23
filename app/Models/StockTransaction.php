<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $fillable = [
        'item_id',
        'transaction_type',
        'quantity',
        'transaction_date',
        'notes',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
