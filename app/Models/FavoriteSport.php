<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteSport extends Model
{
    use HasFactory;

    // Allow mass assignment for the 'name' column
    protected $fillable = ['name'];
}
