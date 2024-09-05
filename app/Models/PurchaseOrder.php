<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'order_date',
        'total_amount',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function receivings()
    {
        return $this->hasMany(Receiving::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_order_details');
    }
}
