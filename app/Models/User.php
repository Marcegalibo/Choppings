<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\ShoppingCart;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'number_id',
        'name',
        'last_name',
        'email',
        'password',
    ];

    protected $appends = ['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d'
    ];

    //Accesores:
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }

    //mutadores:
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function setRememberTokenAttribute()
    {
        $this->attributes['remember_token'] = Str::random(20);
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class, 'user_id','id');
    }
}
