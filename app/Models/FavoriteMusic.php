<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteMusic extends Model
{
    use HasFactory;

    // ADD THIS:
    protected $fillable = ['name'];
}
