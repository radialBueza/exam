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
     * Display the specified resource.
     */
    public function see(Question $question)
    {
        return view('question.show',
        [
            'parent' => $question->exam,
            'info' => $question,
            'datas' => $question->toJson()
        ]);
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
        if ($question->a_file != null) {
            Storage::disk('public')->delete($question->a_file);
        }

        if ($question->b_file != null) {
            Storage::disk('public')->delete($question->b_file);
        }

        if ($question->c_file != null) {
            Storage::disk('public')->delete($question->c_file);
        }
        if ($question->d_file != null) {
            Storage::disk('public')->delete($question->d_file);
        }
        if ($question->question_file != null) {
            Storage::disk('public')->delete($question->question_file);
        }


        $question->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        $question = Question::whereIn('id', $request->items)->get();


        $question->each(function ($item) {
            if ($item->a_file != null) {
                Storage::disk('public')->delete($item->a_file);
            }

            if ($item->b_file != null) {
                Storage::disk('public')->delete($item->b_file);
            }

            if ($item->c_file != null) {
                Storage::disk('public')->delete($item->c_file);
            }
            if ($item->d_file != null) {
                Storage::disk('public')->delete($item->d_file);
            }
            if ($item->question_file != null) {
                Storage::disk('public')->delete($item->question_file);
            }
        });

        Question::destroy($request->items);

        return response(200);
    }
}
