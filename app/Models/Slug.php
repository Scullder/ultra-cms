<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Slug extends Model
{
    protected $fillable = [
        'slug',
        'model_id',
        'model',
        'prefix',
        'postfix',
    ];
}
