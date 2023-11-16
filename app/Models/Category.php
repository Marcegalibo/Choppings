<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $table = "categories"; //nombre de la tabla
    protected $primaryKey = "category_id"; //llave primaria de la tabla categorías

    use HasFactory, SoftDeletes;
    protected $filleable = [
        'name'
    ];

    public function products()
        {

            return $this->hasMany(Product::class, 'category_id','id');
        }
}
