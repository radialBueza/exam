<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Survey;

class ExamTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_exam(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/exams');

        $response->assertOk();

    }

    public function test_view_question(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/exams/1');

        $response->assertOk();
    }

    public function test_view_question_children(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/exams/questions/1');

        $response->assertOk();
    }

    // API
    public function test_view_exam_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->getJson('api/exams', ['search' => 'Abstract Reasoning Exam']);

        $response->assertJsonFragment(['name' => 'Abstract Reasoning Exam']);
    }

    public function test_view_question_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->getJson('api/exams/1?search=tauhan', ['search' => 'tauhan']);

        $response->assertJsonFragment(['question' => 'Ito ay isang tulang pasalaysay na patungkol sa kabayanihan ng pangunahing tauhan.']);
    }

    public function test_create_exam_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('api/exams', [
            'name' => 'new exam',
            'subject_id' => 1,
            'description' => 'testing testing testing testing',
            'grade_level_id' => 1,
            'num_of_questions' => 10,
            'time_limit' => 10
        ]);

        $response->assertCreated();
    }

    public function test_update_exam_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->putJson('api/exams/1', [
            'name' => 'new exam',
            'subject_id' => 1,
            'description' => 'testing testing testing testing',
            'grade_level_id' => 1,
            'num_of_questions' => 10,
            'time_limit' => 10
        ]);

        $response->assertOk();
    }

    public function test_delete_exams_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/exams/1');

        $response->assertOk();
    }

    public function test_delete_many_exams_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/exams', ['items' => [1,2]]);

        $response->assertOk();
    }

    public function test_create_question_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->postJson('api/exams/1', [
            'question' => 'question',
            'a' => 'aaaa',
            'b' => 'bbbb',
            'c' => 'cccc',
            'd' => 'dddd',
            'correct_answer' => 'b'
        ]);

        $response->assertCreated();
    }

    public function test_update_question_api(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->putJson('api/exams/1/1', [
            'question' => 'question',
            'a' => 'aaaa',
            'b' => 'bbbb',
            'c' => 'cccc',
            'd' => 'dddd',
            'correct_answer' => 'b'
        ]);

        $response->assertOk();
    }

    public function test_delete_question_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/exams/questions/1');

        $response->assertOk();
    }

    public function test_delete_many_question_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/questions', ['items' => [1,2]]);

        $response->assertOk();
    }

    // take exam
    public function test_take_exam(): void
    {
        $user = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $user->take_survey = false;
        $user->save();
        $response = $this->actingAs($user)->get('/takeExam/3');

        $response->assertOk();
    }

    public function test_record_exam(): void
    {
        $user = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $user->take_survey = false;
        $user->save();

        $attempt = $user->examAttempts()->create([
            'exam_id' => 3
        ]);

        $response =$this->actingAs($user)->put('/takeExam/3/' . $attempt->id);

        $response->assertRedirectToRoute('examAttempt.result', ['examAttempt' => $attempt->id, 'where' => 'submit']);
    }

    public function test_view_all_exam_result_student(): void
    {
        $user = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $user->take_survey = false;
        $user->save();

        $user->examAttempts()->create([
            'exam_id' => 3,
            'score' => 0,
            'percent' => 0,
            'grade' => 60
        ]);

        $response =$this->actingAs($user)->get('/result');

        $response->assertOk();
    }

    public function test_view_exam_result_student(): void
    {
        $user = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $user->take_survey = false;
        $user->save();

        $attempt = $user->examAttempts()->create([
            'exam_id' => 3,
            'score' => 0,
            'percent' => 0,
            'grade' => 60
        ]);

        $response =$this->actingAs($user)->get('/result/' . $attempt->id . '/');

        $response->assertOk();
    }

    public function test_view_all_exam_student_api(): void
    {
        $user = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $user->take_survey = false;
        $user->save();

        $user->examAttempts()->create([
            'exam_id' => 3,
            'score' => 0,
            'percent' => 0,
            'grade' => 60
        ]);

        $response =$this->actingAs($user)->getJson('api/results?search=Abstract+Reasoning+Exam');

        $response->assertJsonFragment(['exam_name' => 'Abstract Reasoning Exam']);
    }

    public function test_view_teacher_advisor_exam(): void
    {
        $user = User::find(4);
        $stud = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $stud->take_survey = false;
        $stud->save();

        $stud->examAttempts()->create([
            'exam_id' => 2,
            'score' => 0,
            'percent' => 0,
            'grade' => 60
        ]);

        $response =$this->actingAs($user)->get('/examResult/2');

        $response->assertOk();
    }

    public function test_view_teacher_advisor_api(): void
    {
        $user = User::find(4);
        $stud = User::find(5);
        Survey::factory()->create([
            'user_id' => 5
        ]);

        $stud->take_survey = false;
        $stud->save();

        $stud->examAttempts()->create([
            'exam_id' => 2,
            'score' => 0,
            'percent' => 0,
            'grade' => 60
        ]);

        $response =$this->actingAs($user)->getJson('api/examResult/2?search=' . str_replace('_', '+', $stud->name));

        $response->assertJsonFragment(['user_name' => $stud->name]);
    }
}
