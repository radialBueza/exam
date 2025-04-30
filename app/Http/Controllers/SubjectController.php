<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            return Subject::oldest()->get();
        }
        $search = Str::lower($request->search);
        return Subject::oldest()->where('name', 'like', "%{$search}%")->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return view('subject.index',
        [
            'datas' => Subject::oldest()->get()->toJson()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        Subject::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => Subject::oldest()->get(),
        ], 201);
    }

    /**
     *  Search for children API
     */
    public function show(Subject $subject, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function see(Subject $subject)
    {
        return view('subject.show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->name = $request->name;

        $subject->save();

        return response()->json([
            'success' => true,
            'data' => Subject::oldest()->get(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->exams()->exists()) {
            return response()->json([
                'name' => $subject->name,
                'errorMsg' => " has Exams."
            ], 409);
        }

        $subject->delete();

        return response()->noContent();
    }

    public function destroyAll(Request $request)
    {
        $subWithExam = Subject::whereIn('id', $request->items)
            ->has('users')
            ->pluck('name', 'id');

        $canDelete = array_diff($request->items, $subWithExam->keys()->toArray());

        Subject::whereIn('id', $canDelete)->delete();

        if (!empty($subWithExam)) {
            $name = implode(", ", $subWithExam->values()->toArray());
            return response()->json([
                'name' => $name,
                'errorMsg' => " have Exams.",
                'deletedId' => array_values($canDelete)
            ], 409);
        }

        return response()->noContent();
    }
}
