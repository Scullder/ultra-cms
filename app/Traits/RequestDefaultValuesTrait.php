<?php

namespace App\Traits;

trait RequestDefaultValuesTrait
{
    protected function prepareForValidation()
    {
        foreach ($this->defaults as $key => $value) {
            if (!$this->has($key)) {
                $this->merge([$key => $value]);
            }
        }
    }

    public function validated($key = null, $default = null)
    {
        return array_merge($this->defaults, parent::validated());
    }
}