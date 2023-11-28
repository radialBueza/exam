<?php

namespace Tests\Feature;

use App\Models\ExamAttempt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdvisorTest extends TestCase
{

    use RefreshDatabase;

    public function test_view_my_students(): void
    {
        $user = User::find(4);

        $response = $this->actingAs($user)->get('/myStudents');

        $response->assertOk();
    }

    public function test_view_one_student(): void
    {
        $user = User::find(4);

        $response = $this->actingAs($user)->get('/myStudents/5');

        $response->assertOk();
    }

    public function test_search_my_students_api(): void
    {
        $user = User::find(4);

        $response = $this->actingAs($user)->getJson('api/myStudents?search=clark+kent');

        $response->assertJsonFragment(['name' => 'clark kent']);
    }

    public function test_search_one_student_api(): void
    {
        $user = User::find(4);
        ExamAttempt::factory()->create([
            'user_id' => 5,
            'exam_id' => 3,
        ]);

        $response = $this->actingAs($user)->get('api/myStudents/5?search=');

        $response->assertJsonFragment(['exam_name' => 'Abstract Reasoning Exam']);
    }
}
