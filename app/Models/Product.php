<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'category_details_id',
        'category_type_id',
        'name',
        'description',
        'slug'
    ];

    protected $hidden = [
        'is_premium',
        'is_sold',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the galleries for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }
}
