<?php

namespace App\Models;

use App\Models\File;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ShoppingCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'id',
        'name',
		'category_id',
		'stock',
		'description',
        'cost',
        'activo'
	];

    protected $appends = ['format_description'];

	public function formatDescription(): Attribute
	{
		return Attribute::make(
			get: function ($value, $attributes) {
				return Str::limit($attributes['description'], 30, '...',);
			},
			// set: fn ($value) => Str::upper($value)
		);
	}
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function choppingCarts()
    {
        return $this->hasMany(ShoppingCart::class,'id');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
