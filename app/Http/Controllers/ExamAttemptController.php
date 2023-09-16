<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\User;
use App\Models\GradeLevel;
use App\Models\Exam;
use App\Http\Resources\ExamAttemptResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ExamAttemptController extends Controller
{
    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            if (Auth::user()->account_type !== 'student' && Auth::user()->account_type !== 'admin') {
                return ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) {
                    $builder->where('user_id', Auth::id());
                })
                ->oldest()->get());
            }

            if (Auth::user()->account_type === 'admin') {
                return ExamAttemptResource::collection(ExamAttempt::oldest()->get());
            }

            return ExamAttemptResource::collection(Auth::user()->examAttempts()->oldest()->get());
        }

        $search = Str::lower($request->search);
        $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
        $gradeLevel = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();


        if (Auth::user()->account_type !== 'student' && Auth::user()->account_type !== 'admin') {
            $user = User::select('id')->where('name', 'like', "%{$search}%")->get();
            $gradeLevel = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();


            return ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) use($subject, $search, $gradeLevel){
                $builder->where('user_id', Auth::id());
                $builder->where(function(Builder $builder) use($subject, $search, $gradeLevel) {
                    $builder->whereIn('subject_id', $subject);
                    $builder->orWhereIn('grade_level_id', $gradeLevel);
                    $builder->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->orWhereIn('user_id', $user)
            ->oldest()->get());
        }

        if (Auth::user()->account_type === 'admin') {
            $user = User::select('id')->where('name', 'like', "%{$search}%")->get();
            $gradeLevel = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();

            return ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) use($subject, $search, $gradeLevel){
                    $builder->whereIn('subject_id', $subject);
                    $builder->orWhereIn('grade_level_id', $gradeLevel);
                    $builder->orWhere('name', 'like', "%{$search}%");
                })
                ->orWhereIn('user_id', $user)
                ->oldest()->get());
        }

        return ExamAttemptResource::collection(Auth::user()->examAttempts()->whereHas('exam', function(Builder $builder) use($subject, $search){
                $builder->whereIn('subject_id', $subject);
                $builder->orWhere('name', 'like', "%{$search}%");
            })->oldest()->get());

    }

     /**
     * Display a listing of the resource.
     */
    public function all()
    {

        if (Auth::user()->account_type !== 'student' && Auth::user()->account_type !== 'admin') {
            // dd(Auth::user()->exams()->first()->examAttempts()->oldest()->get());
            return view('examAttempt.nonstudent.index',
            [
                'datas' => ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) {
                    $builder->where('user_id', Auth::id());
                })
                ->oldest()->get())->toJson()

            ]);
        }

        if (Auth::user()->account_type === 'admin') {

            return view('examAttempt.nonstudent.index',
            [
                'datas' => ExamAttemptResource::collection(ExamAttempt::oldest()->get())->toJson()
            ]);
        }

        return view('examAttempt.student.index',
        [
            'datas' => ExamAttemptResource::collection(Auth::user()->examAttempts()->oldest()->get())->toJson()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamAttempt $examAttempt)
    {
        return view('examAttempt.result',
        [
            'info' => $examAttempt->exam,
            'attempt' => $examAttempt
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamAttempt $examAttempt)
    {
        //
    }
}
