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
            'num_games_play' => rand(0,6),
            'hrs_play_mobile' => rand(0,6),
            'hrs_play_console' => rand(0,6),
            'hrs_play_pc' => rand(0,6),
            'hrs_play_shooter' => rand(0,6),
            'hrs_play_act_adv' => rand(0,6),
            'hrs_play_sims' => rand(0,6),
            'hrs_play_moba' => rand(0,6),
            'hrs_play_sports' => rand(0,6),
            'hrs_play_racing' => rand(0,6),
            'hrs_play_strat' => rand(0,6),
            'hrs_play_battle_royal' => rand(0,6),
            'hrs_play_puzzle_plat' => rand(0,6),
            'hrs_play_fighting' => rand(0,6),
            'hrs_play_board' => rand(0,6),
            'is_gamer' => rand(0,1) == 1
        ];
    }
}
