<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'slug',
        'name'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get all of the second_job for the ClassJob
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function second_job()
    {
        return $this->hasMany(ClassJob::class, 'parent_id', 'id');
    }

    /**
     * Get the user that owns the ClassJob
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function basic_job()
    {
        return $this->belongsTo(ClassJob::class, 'parent_id', 'id');
    }
}
