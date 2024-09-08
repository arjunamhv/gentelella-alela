<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id',
        'invoice_date',
        'total_amount',
    ];
    protected $casts = [
        'invoice_date' => 'datetime',
    ];


    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
