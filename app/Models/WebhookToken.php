<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WebhookToken extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'trakteer_token', 'saweria_token', 'sociabuzz_token', 'tako_token', 'last_message'
    ];
}
