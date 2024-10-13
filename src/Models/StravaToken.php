<?php

namespace JordanPartridge\LaraBikes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StravaToken extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'access_token',
        'expires_at',
        'refresh_token',
        'athlete_id',
    ];


    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
