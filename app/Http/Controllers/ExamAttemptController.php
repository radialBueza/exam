<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\User;
use App\Models\GradeLevel;
use App\Models\Exam;
use App\Models\Section;
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
            return ExamAttemptResource::collection(Auth::user()->examAttempts()->oldest()->get());
        }

        $search = Str::lower($request->search);
        $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();

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
        return view('examAttempt.student.index',
        [
            'datas' => ExamAttemptResource::collection(Auth::user()->examAttempts()->oldest()->get())->toJson()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function result(ExamAttempt $examAttempt)
    {
        return view('examAttempt.result',
        [
            'info' => $examAttempt->exam,
            'attempt' => $examAttempt
        ]);
    }

    public function allExams(Exam $exam)
    {
        return view('examAttempt.teacher.show',
        [
            'datas' => ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) use($exam){
                $builder->where('id', $exam->id);
            })
            ->oldest()->get())->toJson(),
            'exam' => $exam
        ]);
    }

    public function searchAllExams(Request $request, Exam $exam)
    {
        if (empty($request->search)) {
            return ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) use($exam){
                $builder->where('id', $exam->id);
            })
            ->oldest()->get());
        }

        $search = Str::lower($request->search);
        $section = Section::select('id')->where('name', 'like', "%{$search}%")->get();
        $user = User::select('id')->where('name', 'like', "%{$search}%")->get();

        return ExamAttemptResource::collection(ExamAttempt::whereHas('exam', function(Builder $builder) use($exam){
            $builder->where('id', $exam->id);
        })->where(function (Builder $builder) use($user, $section) {
            $builder->whereHas('user', function (Builder $builder) use($user, $section) {
                $builder->whereIn('id', $user);
                $builder->orWhereIn('section_id', $section);
            });
        })
        ->oldest()->get());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamAttempt $examAttempt)
    {
        //
    }
}
