<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ActiveExamResource;
// use App\Models\Department;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Builder;

class Dashboard extends Controller
{
    public function index()
    {
        if (Auth::user()->account_type === 'student') {

            $testForGradeLevel = Auth::user()->section->gradeLevel->exams()->where('is_active', true)->whereDoesntHave('examAttempts', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })->get();

            $abstractExam = Exam::where('subject_id', 6)->where('is_active', true)->whereDoesntHave('examAttempts', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })->get();
            $allExams = $testForGradeLevel->merge($abstractExam);

            return view('dashboard.student',
            [
                'datas' => ActiveExamResource::collection($allExams)->toJson(),
            ]);
        }elseif (Auth::user()->account_type === 'teacher') {
            return view('dashboard.teacher',
            [
                'datas' => ActiveExamResource::collection(Auth::user()->exams()->has('examAttempts')->oldest()->get())->toJson(),
            ]);
        }

        return view('dashboard.dashboard');
    }
}
