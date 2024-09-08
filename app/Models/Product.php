<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function salesOrders()
    {
        return $this->belongsToMany(SalesOrder::class, 'sales_order_details');
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class, 'purchase_order_details');
    }
}
