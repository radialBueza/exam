<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\GradeLevel;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            if (empty($request->search)) {
                return SectionResource::collection(Section::oldest()->get());
            }
            $search = Str::lower($request->search);
            $gradeLevelId = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();
            return SectionResource::collection(Section::oldest()->where('name', 'like', "%{$search}%")->orWhereIn('grade_level_id', $gradeLevelId)->get());

        }

        return view('section.index',
        [
            'datas' => SectionResource::collection(Section::oldest()->get())->toJson(),
            'options' => GradeLevel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        Section::create($request->validated());

        $id = $request->grade_level_id;

        if ($request->show) {
            return response()->json([
                'success' => true,
                'data' => Section::oldest()->where('grade_level_id', $id)->get(),
            ], 201);
        }

        return response()->json([
            'success' => true,
            'data' => SectionResource::collection(Section::oldest()->get()),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('section.show',
        [
            'info' => $section,
            'parent' => $section->gradeLevel,
            'advisor' => $section->users()->where('account_type', 'teacher')->orWhere('account_type', 'admin')->first(),
            'datas' => $section->users()->where('account_type', 'student')->get()->toJson()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $section->name = $request->name;
        $section->grade_level_id = $request->grade_level_id;

        $section->save();

        $id = $request->grade_level_id;

        if ($request->show) {
            return response()->json([
                'success' => true,
                'data' => Section::oldest()->where('grade_level_id', $id)->get(),
            ], 200);
        }
        return response()->json([
            'success' => true,
            'data' => SectionResource::collection(Section::oldest()->get()),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        Section::destroy($request->items);

        return response(200);
    }
}
