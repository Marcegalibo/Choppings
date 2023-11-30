<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSold extends Model
{
    protected $table = "sold_products";
    protected $fillable = ["shoppingcart_id", "name", "stock", "description", "cost", "amount"];
}
