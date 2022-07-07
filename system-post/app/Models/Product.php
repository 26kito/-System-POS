<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function salesOrders() {
        return $this->belongsTo(SalesOrder::class, 'id_produk');
    }
    public function purchaseOrders() {
        return $this->belongsTo(PurchaseOrder::class, 'id_produk');
    }
}
