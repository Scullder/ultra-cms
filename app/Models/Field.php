<?php

namespace App\Models;

use App\Models\Component;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    protected $casts = [
        'required' => 'boolean',
        'multiple' => 'boolean',
    ];

    /* public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    } */

    /* protected function required(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == true,
            set: fn($value) => $value == true
        );
    } */
}
