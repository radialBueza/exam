<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        Storage::disk('public')->delete($question->a_file);
        Storage::disk('public')->delete($question->b_file);
        Storage::disk('public')->delete($question->c_file);
        Storage::disk('public')->delete($question->d_file);
        Storage::disk('public')->delete($question->question_file);

        $question->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        Question::destroy($request->items);

        return response(200);
    }
}
