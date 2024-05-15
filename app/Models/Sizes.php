<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'SizeId';
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
