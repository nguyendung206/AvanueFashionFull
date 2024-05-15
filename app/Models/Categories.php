<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'CategoryId';

    public function classsifies(){
        return $this->belongsToMany(Classifies::class, 'categories_classifies', 'CategoryId', 'ClassifyId');
    }
}
