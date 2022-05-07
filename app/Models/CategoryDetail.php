<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'job_id',
        'name'
    ];

    protected $hidden = [
        'created_at',
        'udpated_at'
    ];

    /**
     * Get all of the type for the CategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type()
    {
        return $this->hasMany(CategoryType::class, 'category_detail_id', 'id');
    }

    /**
     * Get the category that owns the CategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the jobclass that owns the CategoryDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobclass()
    {
        return $this->belongsTo(ClassJob::class, 'job_id', 'id');
    }
}
