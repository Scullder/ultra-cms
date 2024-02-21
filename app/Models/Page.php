<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Category;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}