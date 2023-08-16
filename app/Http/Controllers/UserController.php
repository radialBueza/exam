<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Section;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            if (empty($request->search)) {
                return User::oldest()->get();

            }
            $search = Str::lower($request->search);
            return User::oldest()->where('name', 'like', "%{$search}%")->get();

        }

        return view('user.index',
        [
            'datas' => User::oldest()->get()->toJson(),
            'options' => Department::all(),
            'sections' => Section::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $password = Str::random();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'birthday' => $request->birthday,
            'account_type' => $request->account_type,
            'department_id' => $request->department_id,
            'section_id' => $request->section_id
        ]);

        event(new Registered($user));

        return response()->json([
            'success' => true,
            'data' => User::oldest()->get(),
            'test' => $password
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
