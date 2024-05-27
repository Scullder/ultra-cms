<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentRequest extends FormRequest
{
    private $fieldsRules = [
        'input' => [
            'label' => 'required',
            'type' => 'required',
            'default' => 'nullable',
            'required' => 'nullable',
            'multiple' => 'nullable',
        ],
        'text' => [
            'label' => 'required',
            'type' => 'required',
            'default' => 'nullable',
            'required' => 'nullable',
            'multiple' => 'nullable',
        ],
        'file' => [
            'label' => 'required',
            'type' => 'required',
            'default' => 'nullable',
            'required' => 'nullable',
            'multiple' => 'nullable',
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // TODO: unique field_code

    /**
     * Поля компонента могут быть разными, поэтому создаём правила валидации на лету 
     * для каждого индекса в зависимости от типа поля
     */
    private function genrateFieldsRules(): array
    {
        $rules = [];
        $codeDuplicates = [];

        foreach (request()->fields as $index => $field) {
            $rule = $this->fieldsRules[$field['type']] ?? [];

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
            'multiple' => 'nullable',
        ];

        if (request()->has('fields')) {
            $rules = array_merge($rules, $this->genrateFieldsRules());
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['global' => $this->has('global')]);
        $this->merge(['multiple' => $this->has('multiple')]);
    }

    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated($key, $default);

        if (isset($validated['fields'])) {
            $validated['fields'] = array_combine(
                array_column($this->fields, 'code'), 
                array_values($this->fields)
            );
        }

        return $validated; 
    }
}
