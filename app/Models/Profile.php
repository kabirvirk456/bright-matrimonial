<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'about',
        'marital_status',
        'highest_qualification',
        'company_position',
        'height',
        'weight',
        'hobby_id',
        'caste_id',
        'religion_id',
        'city_id',
        'state_id',
        'mother_tongue_id',
        'diet',
        'live_with_family',
        'drinking_habits',
        'smoking_habits',
        'open_to_pets',
        'languages_spoken',
        'family_type',
        'mother_occupation',
        'father_occupation',
        'siblings',
        'birth_place',
        'birth_date',
        'birth_time',
        'zodiac_sign',
        'manglik_dosh',
        'hobbies',
        'favorite_music',
        'favorite_books',
        'favorite_movies',
        'favorite_sports',
        'company_name',
        'income',
    ];

    protected $casts = [
        'live_with_family'   => 'boolean',
        'open_to_pets'       => 'boolean',
        'languages_spoken'   => 'array',  // Store as JSON in DB
        'birth_date'         => 'date',
        'siblings'           => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function hobby()
    {
        return $this->belongsTo(\App\Models\Hobby::class, 'hobby_id');
    }

    public function caste()
    {
        return $this->belongsTo(\App\Models\Caste::class, 'caste_id');
    }

    public function religion()
    {
        return $this->belongsTo(\App\Models\Religion::class, 'religion_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class, 'state_id');
    }

    public function motherTongue()
    {
        return $this->belongsTo(\App\Models\MotherTongue::class, 'mother_tongue_id');
    }

    // Debug: See all relationship IDs and actual names/values (for troubleshooting)
    public function getDebugRelationsAttribute()
    {
        return [
            'user_id'     => $this->user_id,
            'user'        => $this->user ? $this->user->first_name : null,
            'religion_id' => $this->religion_id,
            'religion'    => $this->religion ? $this->religion->name : null,
            'caste_id'    => $this->caste_id,
            'caste'       => $this->caste ? $this->caste->name : null,
            'city_id'     => $this->city_id,
            'city'        => $this->city ? $this->city->name : null,
        ];
    }
}
