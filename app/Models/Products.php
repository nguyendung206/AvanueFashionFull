<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ProductId';

    public function colors()
    {
        return $this->belongsToMany(Colors::class, 'products_colors', 'ProductId', 'ColorId');
    }
    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'products_sizes', 'ProductId', 'SizeId');
    }
    public function saleoffs()
    {
        return $this->belongsToMany(Saleoffs::class, 'products_saleoffs', 'ProductId', 'SaleOffId');
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'products_tags', 'ProductId', 'TagId');
    }
    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'orderdetails', 'ProductId', 'OrderId')
            ->withPivot('Quantity', 'SalePrice');
    }
}
