<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text', 'gender', 'order', 'options'];

    // Cast options as array
    protected $casts = [
        'options' => 'array',
    ];
}
