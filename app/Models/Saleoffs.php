<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saleoffs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'saleoffs';
    protected $primaryKey = 'SaleOffId';
    // protected $fillable = ['SaleOffId', 'Type', 'DiscountPrice'];
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
