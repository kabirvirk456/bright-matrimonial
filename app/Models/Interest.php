<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'status',
    ];

    /**
     * The user who received the interest (recipient)
     */
    public function toUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_user_id');
    }

    /**
     * The user who sent the interest (sender)
     */
    public function fromUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_user_id');
    }
}
