<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class SurveyTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_retake_survey(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->put('/api/retakeSurvey');

        $response->assertOk();
    }

    public function test_retake_survey(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->put('/api/retakeSurvey/5');

        $response->assertOk();
    }

    public function test_view_survey(): void
    {
        $user = User::factory()->create([
            'section_id' => 5
        ]);
        $response = $this->actingAs($user)->get('/survey');

        $response->assertStatus(200);
    }

    public function test_take_survey(): void
    {
        $user = User::factory()->create([
            'section_id' => 5
        ]);
        $response = $this->actingAs($user)->post('/survey/' . $user->id, [
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
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
