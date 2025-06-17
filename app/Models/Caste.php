<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caste extends Model
{
    protected $fillable = ['name', 'religion_id'];

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
}
