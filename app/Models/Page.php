<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'categories',
    ];

    /* public function categories()
    {
        return $this->belongsToMany(Category::class);
    } */

    protected function categories(): Attribute
    {
        return Attribute::make(
            get: 
                function (array $categories) {
                    foreach ($categories as $key => $category) {
                        $categories[$key] = Category::find($category);
                    }

                    return $categories;
                },
        );
    }
}
