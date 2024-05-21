<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "orderdetails";

    public function order()
    {
        return $this->belongsTo(Orders::class, 'OrderId', 'OrderId');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'ProductId', 'ProductId');
    }
}
