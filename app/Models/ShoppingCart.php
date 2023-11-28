<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingCart extends Model
{
    use HasFactory, SoftDeletes;
    protected $filleable = [
        'user_id',
        'product_id',


    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
