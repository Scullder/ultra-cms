<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'categories',
        'components',
    ];

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

    protected function components(): Attribute
    {
        $components = Component::where('pages', $this->id)
            ->get()
            ->merge(Component::where('global', true)->get())
            ->toArray();
            
        return Attribute::make(
            get: 
                function (array|null $values) use ($components) {
                    foreach ($components as &$component) {
                        if (!isset($values[$component['code']])) {
                            $values[$component['code']] = $component;
                        }

                        foreach ($component['fields'] as &$field) {
                            if (!isset($values[$component['code']]['fields'][$field['code']]['value'])) {
                                $values[$component['code']]['fields'][$field['code']]['value'] = null;
                            }

                            $values[$component['code']]['fields'][$field['code']] = collect($field)
                                ->except(['value'])
                                ->merge($values[$component['code']]['fields'][$field['code']]);
                        }
                        
                        $values[$component['code']] = collect($component)
                            ->except(['fields'])
                            ->merge($values[$component['code']]);
                    }

                    return $values;
                },
        );
    }
}
