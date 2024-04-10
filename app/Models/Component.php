<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Category;
use App\Models\Page;
use App\Models\Field;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    //use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'categories_pages',
        'categories',
        'pages',
        'global',
        'multiple',
        'fields',
    ];

    /* public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    } */

    protected function categories(): Attribute
    {
        return Attribute::make(
            get: 
                function (array|null $categories) {
                    if (!$categories) {
                        return [];
                    }

                    foreach ($categories as $key => $categoryId) {
                        $categories[$key] = Category::find($categoryId);
                    }

                    return $categories;
                },
        );
    }

    protected function categoriesPages(): Attribute
    {
        return Attribute::make(
            get: 
                function (array|null $categories) {
                    if (!$categories) {
                        return [];
                    }

                    foreach ($categories as $key => $categoryId) {
                        $categories[$key] = Category::find($categoryId);
                    }

                    return $categories;
                },
        );
    }

    protected function pages(): Attribute
    {
        return Attribute::make(
            get: 
                function (array|null $pages) {
                    if (!$pages) {
                        return [];
                    }

                    foreach ($pages as $key => $pageId) {
                        $pages[$key] = Page::find($pageId);
                    }

                    return $pages;
                },
        );
    }

    protected function fields(): Attribute
    {
        return Attribute::make(
            get: fn($fields) => $fields,
            set: 
                function (array $fields) {
                    $mutators = [
                        'required' => fn($val) => boolval($val),
                        'multiple' => fn($val) => boolval($val),
                    ];

                    foreach ($fields as $key => $field) {
                        foreach ($field as $name => $val) {
                            if (isset($mutators[$name])) {
                                $fields[$key][$name] = call_user_func($mutators[$name], $val);
                            }
                        }
                    }

                    return ['fields' => $fields];
                },
        );
    }

}
