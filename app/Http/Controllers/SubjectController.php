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
        $subject->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        Subject::destroy($request->items);

        return response(200);
    }
}
