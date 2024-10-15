<?php

namespace JordanPartridge\LaraBikes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StravaClient extends Model
{
    use HasFactory;

    /**
     * Client
     */
    public function setClientSecretAttribute($value): void
    {
        $this->attributes['client_secret'] = encrypt($value);
    }

    public function getClientSecretAttribute($value): string
    {
        return decrypt($value);
    }
}
