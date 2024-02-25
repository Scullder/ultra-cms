<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;

class ComponentRequest extends FormRequest
{
    private $rules = [
        'input' => [
            'label' => 'required',
            'type' => 'required',
            'default' => 'nullable',
        ],
        'text' => [
            'label' => 'required',
            'type' => 'required',
            'default' => 'nullable',
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Поля компонента могут быть разными, поэтому создаём правила валидации на лету для каждого поля
     */
    private function generateRule($type, $index): array
    {
        $rules = $this->rules[$type] ?? [];
        $rules["fields.{$index}.code"] = 'required|unique:fields,code,' . $this->fields[$index]['code'];

        foreach ($rules as $key => $rule) {
            $rules["fields.{$index}.{$key}"] = $rule;
            unset($rules[$key]);
        }

        return $rules;
    }

    private function genrateFieldsRules(): array
    {
        $rules = [];
        $codeDuplicates = [];

        foreach (request()->fields as $index => $field) {
            $rule = $this->rules[$field['type']] ?? [];

            foreach ($rule as $key => $item) {
                $rule["fields.{$index}.{$key}"] = $item;
                unset($rule[$key]);
            }

            $rule["fields.{$index}.code"] = 'required|unique:fields,code';
            
            // Предотвращение повторяющихся кодов внутри запроса
            if (!in_array($field['code'], $codeDuplicates)) {
                $rule["fields.{$index}.code"] .= ',' . $index . ',_id';
                $codeDuplicates[] = $field['code'];
            }

            $rules = array_merge($rules, $rule);
        }

        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'categories_pages' => 'nullable|array',
            'categories' => 'nullable|array',
            'pages' => 'nullable|array',
            'global' => 'nullable',
        ];

        if (request()->has('fields')) {
            $rules = array_merge($rules, $this->genrateFieldsRules());
        }

        return $rules;
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            //dd($this->request);
            //session()->flash('categories_pages', $this->creategories_pages);
            //dd(Session::all());
        });
    }

    protected function prepareForValidation()
    {
        $this->merge(['global' => $this->has('global')]);
    }
}
