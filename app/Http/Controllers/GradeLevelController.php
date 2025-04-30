<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\GradeLevelRequest;
use App\Http\Resources\GradeLevelResource;
use App\Models\Department;
use App\Http\Requests\GradeLevelChild;
use App\Models\Section;
use Illuminate\Database\Eloquent\Builder;

class GradeLevelController extends Controller
{
    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            return GradeLevelResource::collection(GradeLevel::oldest()->get());
        }
        $search = Str::lower($request->search);
        $deptId = Department::select('id')->where('name', 'like', "%{$search}%")->get();
        return GradeLevelResource::collection(GradeLevel::oldest()->where(function (Builder $builder) use($search, $deptId){
            $builder->where('name', 'like', "%{$search}%");
            $builder->orWhereIn('department_id', $deptId);
        })->get());

    }

     /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return view('gradeLevel.index',
        [
            'datas' => GradeLevelResource::collection(GradeLevel::oldest()->get())->toJson(),
            'options' => Department::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeLevelRequest $request)
    {
        GradeLevel::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => GradeLevelResource::collection(GradeLevel::oldest()->get()),
        ], 201);
    }

    /**
     * Search Children API
     */
    public function show(GradeLevel $gradeLevel, Request $request)
    {
        if (empty($request->search)) {
            return $gradeLevel->sections;

        }
        $search = Str::lower($request->search);
        return $gradeLevel->sections()->where('name', 'like', "%{$search}%")->get();

    }

    /**
     * Display the specified resource.
     */
    public function see(GradeLevel $gradeLevel)
    {
        return view('gradeLevel.show',
        [
            'info' => $gradeLevel,
            'parent' => $gradeLevel->department,
            'datas' => $gradeLevel->sections->toJson()
        ]);
    }

    /**
     *  Create children of specific resource API
     */

     public function createFor(GradeLevel $gradeLevel, GradeLevelChild $request)
     {
         $gradeLevel->sections()->create($request->validated());

         return response()->json([
             'success' => true,
             'data' => $gradeLevel->sections,
         ], 201);
     }

     /**
      *  Update children of specific resource API
      */

      public function updateFor(GradeLevel $gradeLevel, GradeLevelChild $request, Section $section)
      {
         $section->name = $request->name;
         $section->save();

         return response()->json([
             'success' => true,
             'data' => $gradeLevel->sections,
         ], 200);
      }


    /**
     * Update the specified resource in storage.
     */
    public function update(GradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        $gradeLevel->name = $request->name;
        $gradeLevel->department_id = $request->department_id;

        $gradeLevel->save();

        return response()->json([
            'success' => true,
            'data' => GradeLevelResource::collection(GradeLevel::oldest()->get()),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeLevel $gradeLevel)
    {
        if ($gradeLevel->sections()->exists() || $gradeLevel->exams()->exists()) {
            return response()->json([
                'name' => $gradeLevel->name,
                'errorMsg' => " has existing Sections or Exams."
            ], 409);
        }

        $gradeLevel->delete();

        return response()->noContent();
    }

    public function destroyAll(Request $request)
    {

        $gradeWithSec = GradeLevel::whereIn('id', $request->items)
            ->where(function ($query) {
                $query->has('sections')
                    ->orHas('exams');
            })->pluck('name', 'id');

        $canDelete = array_diff($request->items, $gradeWithSec->keys()->toArray());

        GradeLevel::whereIn('id', $canDelete)->delete();

        if (!empty($gradeWithSec)) {
            $name = implode(", ", $gradeWithSec->values()->toArray());
            return response()->json([
                'name' => $name,
                'errorMsg' => " have existing Sections or Exams.",
                'deletedId' => array_values($canDelete)
            ], 409);
        }

        return response()->noContent();
    }
}
