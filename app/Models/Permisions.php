<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'PermisionId';

    public function employees() {
        return $this->hasMany(Employees::class);
    }
}
