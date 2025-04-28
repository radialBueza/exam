<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Str;
use App\Http\Requests\DepartmentChild;
use App\Models\GradeLevel;

class DepartmentController extends Controller
{

    /**
     * Search API
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            return Department::oldest()->get();

        }
        $search = Str::lower($request->search);
        return Department::oldest()->where('name', 'like', "%{$search}%")->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        return view('department.index',
        [
            'datas' => Department::oldest()->get()->toJson()
        ]);
    }
    /**
     * Store a newly created resource in storage. API
     */
    public function store(DepartmentRequest $request)
    {

        Department::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => Department::oldest()->get(),
        ], 201);
    }

    /**
     * Search for children API
     */

    public function show(Department $department, Request $request)
    {
        if (empty($request->search)) {
            return $department->gradeLevels;

        }
        $search = Str::lower($request->search);
        return $department->gradeLevels()->where('name', 'like', "%{$search}%")->get();
    }

    /**
     * Display the specified resource.
     */
    public function see(Department $department)
    {
        return view('department.show',
        [
            'info' => $department,
            'admin' => $department->user,
            'datas' => $department->gradeLevels->toJson()
        ]);
    }

    /**
     *  Create children of specific resource API
     */

    public function createFor(Department $department, DepartmentChild $request)
    {
        $department->gradeLevels()->create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $department->gradeLevels,
        ], 201);
    }

    /**
     *  Update children of specific resource API
     */

     public function updateFor(Department $department, DepartmentChild $request, GradeLevel $gradeLevel)
     {
        $gradeLevel->name = $request->name;
        $gradeLevel->save();

        return response()->json([
            'success' => true,
            'data' => $department->gradeLevels,
        ], 200);
     }


    /**
     * Update the specified resource in storage. API
     */
    public function update(DepartmentRequest $request, Department $department)
    {

        $department->name = $request->name;

        $department->save();

        return response()->json([
            'success' => true,
            'data' => Department::oldest()->get(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage. API
     */
    public function destroy(Department $department)
    {
        if ($department->gradeLevels()->exists()) {
            return response()->json([
                'name' => $department->name,
                'errorMsg' => " has existing Grade Levels."
            ], 409);
        }

        $department->delete();

        return response()->noContent();
    }

    // Destory multiple items API

    public function destroyAll(Request $request)
    {
        // Department::destroy($request->items);

        $depWithGrade = Department::whereIn('id', $request->items)
            ->has('gradeLevels') // or use whereHas() if you need filters
            ->pluck('name', 'id');

        $canDelete = array_diff($request->items, $depWithGrade->keys()->toArray());

        Department::whereIn('id', $canDelete)->delete();

        if (!empty($depWithGrade)) {
            $name = implode(", ", $depWithGrade->values()->toArray());
            return response()->json([
                'name' => $name,
                'errorMsg' => " have existing Grade Levels.",
                'deletedId' => array_values($canDelete)
            ], 409);
        }

        return response()->noContent();
    }
}
