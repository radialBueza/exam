<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\GradeLevel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ExamResource;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            // return ExamResource::collection(GradeLevel::oldest()->get());
            if (Auth::user()->account_type === 'admin') {
                return ExamResource::collection(Exam::oldest()->get());
            }else {
                return ExamResource::collection(Auth::user()->exams);
            }
        }
        $search = Str::lower($request->search);
        $userId = User::select('id')->where('name', 'like', "%{$search}%")->get();
        $subjectId = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
        $gradeLevelId = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();

        if (Auth::user()->account_type === 'admin') {
            return ExamResource::collection(Exam::oldest()->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%")->orWhereIn('user_id', $userId)->orWhereIn('subject_id', $subjectId)->orWhereIn('grade_level_id', $gradeLevelId)->get());
        }else {
            return ExamResource::collection(Auth::user()->exams()->oldest()->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%")->orWhereIn('user_id', $userId)->orWhereIn('subject_id', $subjectId)->orWhereIn('grade_level_id', $gradeLevelId)->get());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        if (Auth::user()->account_type === 'admin') {
            $datas = ExamResource::collection(Exam::oldest()->get())->toJson();
        }else {
            $datas = ExamResource::collection(Auth::user()->exams)->toJson();
        }


        return view('exam.index',
        [
            'datas' => $datas,
            'subject' => Subject::all(),
            'gradeLevel' => GradeLevel::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        // $user = User::find(Auth::id());
        // $user->exams()->create($request->validated());
        Auth::user()->exams()->create($request->validated());

        if (Auth::user()->account_type === 'admin') {
            $datas = ExamResource::collection(Exam::oldest()->get());
        }else {
            $datas = ExamResource::collection(Auth::user()->exams);
        }

        return response()->json([
            'success' => true,
            'data' => $datas,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function see(Exam $exam)
    {
        $options = collect([]);

        // $object = ;

        $options->push((object)[
            'id' => 'a',
            'name' => 'Option A'
        ]);

        $options->push((object)[
            'id' => 'b',
            'name' => 'Option B'
        ]);

        $options->push((object)[
            'id' => 'c',
            'name' => 'Option C'
        ]);

        $options->push((object)[
            'id' => 'd',
            'name' => 'Option D'
        ]);

        return view('exam.show',
        [
            'datas' => $exam->questions->toJson(),
            'info' => new ExamResource($exam),
            'options' => $options
        ]);
    }

    /**
     * Search for children API
     */
    public function show(Exam $exam, Request $request)
    {
        if (empty($request->search)) {
            return $exam->questions;

        }
        $search = Str::lower($request->search);
        return $exam->questions()->where('name', 'like', "%{$search}%")->get();
    }

    /**
     *  Create children of specific resource API
     */

     public function createFor(Exam $exam, QuestionRequest $request)
     {
        $data = $request->validated();

        if ($request->hasFile('question_file')) {
            $path = $request->question_file->store('questions', 'public');

            // $data->replace(['question_file' => $path]);
            $data['question_file'] = $path;

        }

        if ($request->hasFile('a_file')) {
            $path = $request->a_file->store('answers', 'public');

            // $data->replace(['a_file' => $path]);
            $data['a_file'] = $path;

        }

        if ($request->hasFile('b_file')) {
            $path = $request->b_file->store('answers', 'public');

            // $data->replace(['b_file' => $path]);
            $data['b_file'] = $path;

        }

        if ($request->hasFile('c_file')) {
            $path = $request->c_file->store('answers', 'public');

            // $data->replace(['c_file' => $path]);
            $data['c_file'] = $path;

        }

        if ($request->hasFile('d_file')) {
            $path = $request->d_file->store('answers', 'public');

            // $data->replace(['d_file' => $path]);
            $data['d_file'] = $path;

        }

        $exam->questions()->create($data);

         return response()->json([
             'success' => true,
             'data' => $exam->questions,
         ], 201);
     }


    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->name = $request->name;
        $exam->subject_id = $request->subject_id;
        $exam->grade_level_id = $request->grade_level_id;
        $exam->description = $request->description;
        $exam->num_of_questions = $request->num_of_questions;
        $exam->time_limit = $request->time_limit;

        $exam->save();

        if (Auth::user()->account_type === 'admin') {
            $datas = ExamResource::collection(Exam::oldest()->get());
        }else {
            $datas = ExamResource::collection(Auth::user()->exams);
        }

        return response()->json([
            'success' => true,
            'data' => $datas,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {

        $exam->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        Exam::destroy($request->items);

        return response(200);
    }
}
