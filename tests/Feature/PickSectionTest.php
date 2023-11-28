<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class PickSectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_view_pick_section(): void
    {
        $user = User::factory()->create([
            'take_survey' => false
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirectToRoute('pickSection');
    }

    public function test_user_submit_pick_section(): void
    {
        $user = User::factory()->create([
            'take_survey' => false
        ]);

        $response = $this->actingAs($user)->put('/student/picksection/' . $user->id, ['section_id' => 1]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
