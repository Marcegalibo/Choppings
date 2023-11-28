<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $filleable = ['name'];
    protected $appends = ['five_products'];

    public function getFiveProductsAttribute () {
       $this->products()->take('5');
    }

    public function products()
        {
            return $this->hasMany(Product::class, 'category_id','id');
        }
}
