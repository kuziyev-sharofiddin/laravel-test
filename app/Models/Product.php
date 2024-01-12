<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'product_code'];
    public function product_materials(): HasMany
    {
        return $this->hasMany(ProductMaterial::class);
    }
}
