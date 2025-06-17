<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $fillable = ['name'];

    public function castes()
    {
        return $this->hasMany(Caste::class);
    }
}
