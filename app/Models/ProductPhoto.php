<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productphoto';
    protected $primaryKey = 'PhotoId';
    public function product()
    {
        return $this->belongsTo(Products::class,'ProductId');
    }
}
