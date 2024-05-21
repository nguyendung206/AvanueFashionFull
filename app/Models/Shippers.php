<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shippers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ShipperId';
    public function orders()
    {
        return $this->hasMany(Orders::class, 'ShipperId');
    }
}
