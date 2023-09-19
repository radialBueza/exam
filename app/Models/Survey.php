<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_games_play',
        'hrs_play_mobile',
        'hrs_play_console',
        'hrs_play_pc',
        'hrs_play_shooter',
        'hrs_play_act_adv',
        'hrs_play_sims',
        'hrs_play_moba',
        'hrs_play_sports',
        'hrs_play_racing',
        'hrs_play_strat',
        'hrs_play_battle_royal',
        'hrs_play_puzzle_plat',
        'hrs_play_fighting',
        'hrs_play_board',
        'is_gamer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
