<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Customers extends Model implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable;
    public function getAuthIdentifierName()
    {
        return 'CustomerId'; // Thay 'CustomerId' bằng tên cột chứa ID của khách hàng trong cơ sở dữ liệu
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // Khách hàng không sử dụng remember token
    }

    public function setRememberToken($value)
    {
        // Khách hàng không sử dụng remember token
    }

    public function getRememberTokenName()
    {
        return null; // Khách hàng không sử dụng remember token
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    public $timestamps = false;
    protected $primaryKey = 'CustomerId';
    public function orders()
    {
        return $this->hasMany(Orders::class, 'CustomerId', 'CustomerId');
    }
    protected $fillable = [
        'email',
        'password',
        'permisionId',
        'FullName',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
