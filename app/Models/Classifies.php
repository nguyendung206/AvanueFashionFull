<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classifies extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ClassifyId';
    
    public function categories()
    {
        return $this->belongsToMany(Categories::class);
    }
}
