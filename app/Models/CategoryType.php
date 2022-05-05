<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_detail_id',
        'name'
    ];

    protected $hidden = [
        'created_at',
        'udpated_at'
    ];
}
