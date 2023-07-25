<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
use App\Http\Requests\Store;
use App\Http\Requests\Update;
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
            'datas' => Department::oldest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        // $validated = $request->validate([
        //     'name' => ['unique:App\Models\Department,name', 'min:4', 'max:20', ]
        // ]);

        // neww
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
            'data' => $department
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Department $department)
    {
        //
        // $validated = $request->validate([
        //     'name' => [Rule::unique('departments')->ignore($department), 'min:4', 'max:20', ]
        // ]);

        $department->name=$request->name;

        $department->save();

        return response()->json([
            'success' => true,
            'data' => Department::oldest()->get(),
            // // 'data' => 'test',
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
