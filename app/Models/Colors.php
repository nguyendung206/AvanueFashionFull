<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ColorId';

    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
}
