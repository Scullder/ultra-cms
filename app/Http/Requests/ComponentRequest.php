<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentRequest extends FormRequest
{
    private $rules = [
        'input' => [
            'name' => 'required',
            //'required' => 'nullable',
            //'multiple' => 'nullable',
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function generateRules($type, $name): array
    {
        $rules = $this->rules[$type] ?? [];

        foreach ($rules as $key => $rule) {
            $rules["fields.{$name}.{$key}"] = $rule;
            unset($rules[$key]);
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
        //dd(request()->fields);

        $rules = [
            'fields' => 'required',
            'name' => 'required',
            'code' => 'required',
        ];

        if (request()->has('fields')) {
            foreach (request()->fields as $key => $field) {
                $rules = array_merge($rules, $this->generateRules($field['type'], $key));
            }
        }

        return $rules;
    }

    public function withValidator($validator) {
       /*  $validator->after(function ($validator) {
            dd($validator->errors());
        }); */
    }
}
