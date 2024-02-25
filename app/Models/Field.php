<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Component;

class Field extends Model
{
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }
}
