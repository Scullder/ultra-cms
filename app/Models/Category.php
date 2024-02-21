<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Page;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
