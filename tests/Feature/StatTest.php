<?php

namespace Tests\Feature;

use App\Models\ExamAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatTest extends TestCase
{

    use RefreshDatabase;

    public function test_example(): void
    {
        $user = User::find(1);

        $new = User::factory()
                    ->count(5)
                    ->has(
                        ExamAttempt::factory()
                        ->state(function (array $attributes) {
                            return ['exam_id' => 3];
                        }))
                    ->create();
        $response = $this->actingAs($user)->get('/stat');

        $response->assertViewHasAll([
            'gamer',
            'nonGamer',
            'all'
        ]);
    }
}
