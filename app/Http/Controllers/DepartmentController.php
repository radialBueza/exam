<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

            return Department::oldest()->where('name', 'like', '%' . $request->search . '%')->get();

        }

        return view('original/department/deparment',
        [
            'datas' => Department::oldest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['unique:App\Models\Department,name', 'min:4', 'max:20', ]
        ]);

        // neww
        Department::create($validated);

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
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
        $validated = $request->validate([
            'name' => [Rule::unique('departments')->ignore($department), 'min:4', 'max:20', ]
        ]);

        $department->name=$request->name;

        $department->save();

        return response()->json([
            'success' => true,
            'data' => Department::oldest()->get(),
            // 'data' => 'test',
        ], 201);
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
