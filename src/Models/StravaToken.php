<?php

namespace JordanPartridge\LaraBikes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('larabikes.user_model', 'App\Models\User'));
    }
}
