<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Subject;
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
        return view('examAttempt.index',
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
