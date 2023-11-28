<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\GradeLevel;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\ExamAttempt;


class AdminTest extends TestCase
{
    use RefreshDatabase;

    // HTTP Request
    public function test_view_department_page(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/departments');

        $response->assertSeeText('Departments');

    }

    public function test_view_department_children(): void
    {
        $user = User::find(1);
        $dept = Department::find(1);
        $response = $this->actingAs($user)->get('/departments/1');

        $response->assertSeeText('Department | ' . ucwords($dept->name));
    }

    public function test_view_grade_level_page(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/gradeLevels');

        $response->assertSeeText('Grade Levels');
    }

    public function test_view_grade_level_children(): void
    {
        $user = User::find(1);
        $grade = GradeLevel::find(1);
        $response = $this->actingAs($user)->get('/gradeLevels/1');

        $response->assertSeeText('Grade Level | ' . ucwords($grade->name));
    }

    public function test_view_section_page(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/sections');

        $response->assertSeeText('Sections');
    }

    public function test_view_section_children(): void
    {
        $user = User::find(1);
        $sect = Section::find(1);
        $response = $this->actingAs($user)->get('/sections/1');

        $response->assertSeeText('Section | ' . ucwords($sect->name));
    }

    public function test_view_subject_page(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/subjects');

        $response->assertSeeText('Subjects');
    }

    public function test_view_accounts_page(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/users');

        $response->assertSeeText('Accounts');
    }

    public function test_view_accounts_admin(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/users/' . $user->id);

        $response->assertSeeText(ucwords($user->name));
    }

    public function test_view_accounts_student(): void
    {
        $user = User::find(1);

        $check = User::where('account_type', 'student')->first();
        $response = $this->actingAs($user)->get('/users/' . $check->id);

        $response->assertSeeText(ucwords($check->name));
    }

    // API Request
    public function test_view_department_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/departments?search=high+school');

        $response->assertJsonFragment(['name' => 'high school']);
    }

    public function test_create_department_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/departments', ['name' => 'wizards']);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'wizards']);
    }

    public function test_edit_department_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/departments/1', ['name' => 'wizards']);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'wizards']);
    }

    public function test_delete_department_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/departments/1');

        $response->assertOk();
    }

    public function test_delete_many_department_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/departments', ['items' => [1,2]]);

        $response->assertOk();
    }

    public function test_view_department_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/departments/1?search=grade+07');

        $response->assertJsonFragment(['name' => 'grade 07']);
    }

    public function test_create_for_department_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/departments/1', ['name' => 'grade 11']);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'grade 11']);
    }

    public function test_edit_for_department_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/departments/1/1', ['name' => 'grade 20']);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'grade 20']);
    }

    // Grade Level
    public function test_view_grade_level_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/gradeLevels?search=grade+07');

        $response->assertJsonFragment(['name' => 'grade 07']);
    }

    public function test_create_grade_level_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/gradeLevels', ['name' => 'grade 12', 'department_id' => 1]);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'grade 12']);
    }

    public function test_edit_grade_level_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/gradeLevels/1', ['name' => 'grade genius', 'department_id' => 1]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'grade genius']);
    }

    public function test_delete_grade_level_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/gradeLevels/1');

        $response->assertOk();
    }

    public function test_delete_many_grade_level_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/gradeLevels', ['items' => [1,2]]);

        $response->assertOk();
    }

    public function test_view_grade_level_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/gradeLevels/1?search=dalton');

        $response->assertJsonFragment(['name' => 'dalton']);
    }

    public function test_create_for_grade_level_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/gradeLevels/1', ['name' => 'bravery']);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'bravery']);
    }

    public function test_edit_for_grade_level_children_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/gradeLevels/1/1', ['name' => 'titan']);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'titan']);
    }

    //section
    public function test_view_section_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/sections?search=dalton');

        $response->assertJsonFragment(['name' => 'dalton']);
    }

    public function test_create_section_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/sections', ['name' => 'supers', 'grade_level_id' => 1]);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'supers']);
    }

    public function test_edit_section_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/sections/1', ['name' => 'titan', 'grade_level_id' => 1]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'titan']);
    }

    public function test_delete_section_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/sections/1');

        $response->assertOk();
    }

    public function test_delete_many_section_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/sections', ['items' => [1,2]]);

        $response->assertOk();
    }

    // Subjects
    public function test_view_subject_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/subjects?search=math');

        $response->assertJsonFragment(['name' => 'math']);
    }

    public function test_create_subject_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/subjects', ['name' => 'trigonometry']);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'trigonometry']);
    }

    public function test_edit_subject_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/subjects/1', ['name' => 'potions']);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'potions']);
    }

    public function test_delete_subject_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/subjects/1');

        $response->assertOk();
    }

    public function test_delete_many_subject_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/subjects', ['items' => [1,2]]);

        $response->assertOk();
    }

    // Accounts
    public function test_view_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/users?search=radial+moses');

        $response->assertJsonFragment(['name' => 'radial moses']);
    }

    public function test_create_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->postJson('/api/users', [
            'name' => 'peter parker',
            'account_type' => 'student',
            'email' => 'real@mail.com',
            'birthday' => '1997-12-12',
            'gender' => 'male',
            'section_id' => 1
        ]);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'peter parker']);
    }

    public function test_edit_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->putJson('/api/users/1', [
            'name' => 'peter parker',
            'email' => 'real@mail.com',
            'birthday' => '1997-12-12',
            'gender' => 'male',
            'account_type' => 'student',
            'section_id' => 1
        ]);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'peter parker']);
    }

    public function test_delete_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/users/1');

        $response->assertOk();
    }

    public function test_delete_many_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->deleteJson('/api/users', ['items' => [1,2]]);

        $response->assertOk();
    }

    public function test_view_admin_advisor_exams_users_api(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->getJson('/api/users/1/exams?search=Abstract+Reasoning+Exam');

        $response->assertJsonFragment(['name' => 'Abstract Reasoning Exam']);
    }

    public function test_view_admin_advisor_student_users_api(): void
    {
        $user = User::find(1);
        $sect = Section::find(1);
        $stu = User::factory()->make();
        $sect->users()->save($stu);
        $response = $this->actingAs($user)->getJson('/api/users/1/students?search=' . str_replace('_', '+', $stu->name));

        $response->assertJsonFragment(['name' => $stu->name]);
    }

    public function test_view_student_users_api(): void
    {
        $user = User::find(1);
        $exam = User::find(5)->examAttempts()->save(ExamAttempt::factory()->make([
            'exam_id' => 3
        ]));

        $response = $this->actingAs($user)->getJson('/api/users/5?search=Abstract+Reasoning+Exam');

        $response->assertJsonFragment(['exam_name' => 'Abstract Reasoning Exam']);
    }
}
