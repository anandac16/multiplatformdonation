<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overlay extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'milestone_title', 'milestone_target', 'milestone_bg_color', 'milestone_text_color',
        'leaderboard_title', 'leaderboard_range', 'leaderboard_bg_color', 'leaderboard_text_color',
    ];
}
