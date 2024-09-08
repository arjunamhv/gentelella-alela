<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'order_date',
        'total_amount',
        'status',
    ];
    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function receivings()
    {
        return $this->hasMany(Receiving::class);
    }
}
