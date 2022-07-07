<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    public function customers() {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function products() {
        return $this->hasMany(Product::class, 'id_produk');
    }
}
