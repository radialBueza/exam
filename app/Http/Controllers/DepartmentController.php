<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            if (empty($request->search)) {
                return Department::oldest()->get();

            }

            return Department::oldest()->where('name', 'like', '%' . Str::lower($request->search) . '%')->get();

        }

        return view('department.index',
        [
            'datas' => Department::oldest()->get()->toJson()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {

        Department::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => Department::oldest()->get(),
            // 'data' => 'test',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {

        return view('department.show',
        [
            'name' => $department->name,
            'admin' => $department->user()->get(),
            'datas' => $department->gradeLevel()->get()->toJson()
        ]);
    }


    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'success' => true
        ], 200);
    }

    // Destory multiple items

    public function destroyAll(Request $request)
    {
        Department::destroy($request->items);

        return response()->json([
            'success' => true
        ], 200);
    }
}
