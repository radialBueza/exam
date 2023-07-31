<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\GradeLevelRequest;
use App\Http\Resources\GradeLevelResource;
use App\Models\Department;
use Illuminate\Database\Query\Builder;
// use Illuminate\Database\Eloquent\Builder;

class GradeLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            if (empty($request->search)) {
                return GradeLevelResource::collection(GradeLevel::oldest()->get());
            }
            $search = Str::lower($request->search);
            $deptId = Department::select('id')->where('name', 'like', "%{$search}%")->get();
            return GradeLevelResource::collection(GradeLevel::oldest()->where('name', 'like', "%{$search}%")->orWhereIn('department_id', $deptId)->get());

        }

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
        // $value = $request->validated();

        $id = $request->department_id;

        if ($request->show) {
            return response()->json([
                'success' => true,
                'data' => GradeLevel::oldest()->where('department_id', $id)->get(),
            ], 201);
        }

        return response()->json([
            'success' => true,
            'data' => GradeLevelResource::collection(GradeLevel::oldest()->get()),
            'test' => $request->path()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeLevel $gradeLevel)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(GradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        $gradeLevel->name = $request->name;
        $gradeLevel->department_id = $request->department_id;

        $gradeLevel->save();

        $id = $request->department_id;

        if ($request->show) {
            return response()->json([
                'success' => true,
                'data' => GradeLevel::oldest()->where('department_id', $id)->get(),
            ], 200);
        }
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
        $gradeLevel->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        GradeLevel::destroy($request->items);

        return response(200);
    }
}
