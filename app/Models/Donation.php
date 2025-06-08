<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'transaction_id',
        'name',
        'amount',
        'message',
        'platform'
    ];

    public function token()
    {
        return $this->belongsTo(Token::class, 'uuid', 'uuid');
    }
}
