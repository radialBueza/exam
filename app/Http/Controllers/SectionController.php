<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Builder;

class SectionController extends Controller
{
    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            return SectionResource::collection(Section::oldest()->get());
        }
        $search = Str::lower($request->search);
        $gradeLevelId = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();
        return SectionResource::collection(Section::oldest()->where(function (Builder $builder) use($search, $gradeLevelId) {
            $builder->where('name', 'like', "%{$search}%");
            $builder->orWhereIn('grade_level_id', $gradeLevelId);
        })->get());

    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
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

        return response()->json([
            'success' => true,
            'data' => SectionResource::collection(Section::oldest()->get()),
        ], 201);
    }

    /**
     * Search Children API
     */
    public function show(Section $section, Request $request)
    {
        if (empty($request->search)) {
            return $section->users()->where('account_type', 'student')->get();

        }
        $search = Str::lower($request->search);
        return $section->users()->where('name', 'like', "%{$search}%")->where('account_type', 'student')->get();
    }

    /**
     * Display the specified resource.
     */
    public function see(Section $section)
    {
        return view('section.show',
        [
            'info' => $section,
            'parent' => $section->gradeLevel,
            // 'advisor' => $section->users()->where('account_type', 'admin')->orWhere('account_type', 'advisor')->first(),
            'advisor' => $section->users()->where(function (Builder $builder) {
                $builder->where('account_type', 'admin');
                $builder->orWhere('account_type', 'advisor');
            })->first(),
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
