<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'num_games_play' => 1,
            'hrs_play_mobile' => 1,
            'hrs_play_console' => 1,
            'hrs_play_pc' => 1,
            'hrs_play_shooter' => 1,
            'hrs_play_act_adv' => 1,
            'hrs_play_sims' => 1,
            'hrs_play_moba' => 1,
            'hrs_play_sports' => 1,
            'hrs_play_racing' => 1,
            'hrs_play_strat' => 1,
            'hrs_play_battle_royal' => 1,
            'hrs_play_puzzle_plat' => 1,
            'hrs_play_fighting' => 1,
            'hrs_play_board' => 1,
            'is_gamer' => 1
        ];
    }
}
