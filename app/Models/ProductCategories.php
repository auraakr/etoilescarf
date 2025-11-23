<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
