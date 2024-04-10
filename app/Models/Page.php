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

    /**
     * Собираем все компоненты привязанные к странице и привязываем сохранённые значеия если они есть.
     * Если поле в элементах строк(fields) компонента имеет названеи value оно будет заменено значением.
     */
    public function loadComponents()
    {
        $components = Component::where('pages', $this->id)
            ->with('fields')
            ->get()
            ->merge(
                Component::where('global', true)
                    ->with('fields')
                    ->get()
            );


        foreach ($components as &$component) {
            foreach ($component->fields as &$field) {
                $field->value = $this->components[$component['code']][$field['code']] ?? null;
                // if (isset($this->components[$component['code']][$field['code']]))
            }
            unset($field);
        }
        unset($component);

        $this->components = $components;

        /* dd($components->toArray());
        dd($this->components); */

        //return $components;
    }
}
