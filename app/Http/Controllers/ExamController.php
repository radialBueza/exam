<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Resources\ExamResource;

class ExamController extends Controller
{
    /**
     * Search API
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return view('exam.index',
        [
            'datas' => ExamResource::collection(Exam::oldest()->get())->toJson()
        ]);
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
    public function see(Exam $department)
    {
        return view('department.show',
        [

        ]);
    }

    /**
     * Search for children API
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
