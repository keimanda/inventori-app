<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StockTransaction;

class Item extends Model
{
    protected $fillable = [
        'item_code',
        'name',
        'category_id',
        'unit',
        'stock',
        'minimum_stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function getStockStatusAttribute()
    {
        return $this->stock <= $this->minimum_stock
            ? 'Menipis'
            : 'Aman';
    }
}
