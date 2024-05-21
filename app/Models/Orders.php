<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'OrderId';
    public function employee()
    {
        return $this->belongsTo(Employees::class, 'EmployeeId', 'EmployeeId');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'CustomerId', 'CustomerId');
    }

    public function shipper()
    {
        return $this->belongsTo(Shippers::class, 'ShipperId');
    }

    public function products()
    {
        return $this->belongsToMany(Products::class, 'orderdetails', 'OrderId', 'ProductId')
            ->withPivot('Quantity', 'SalePrice');
    }
    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'OrderId', 'OrderId');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'Status', 'Status');
    }
}
