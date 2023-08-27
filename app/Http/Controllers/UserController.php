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
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;

class UserController extends Controller
{
    /**
     * Search
     */
    public function index(Request $request)
    {
        if (empty($request->search)) {
            return User::oldest()->get();
        }
        $search = Str::lower($request->search);
        return User::oldest()->where('name', 'like', "%{$search}%")->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $accountType = collect([]);

        $accountType->push((object)[
            'id' => 'admin',
            'name' => 'Admin'
        ]);

        $accountType->push((object)[
            'id' => 'advisor',
            'name' => 'advisor'
        ]);

        $accountType->push((object)[
            'id' => 'teacher',
            'name' => 'teacher'
        ]);

        $accountType->push((object)[
            'id' => 'student',
            'name' => 'Student'
        ]);
        return view('user.index',
        [
            'datas' => User::oldest()->get()->toJson(),
            'options' => Department::all(),
            'sections' => Section::orderBy('grade_level_id', 'asc')->get(),
            'accountType' => $accountType
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

        // capitalize name
        $user->name = ucwords($user->name);

        // Add name of user to email
        Mail::to($user)->send(new AccountCreated($password, $request->name));

        event(new Registered($user));

        return response()->json([
            'success' => true,
            'data' => User::oldest()->get(),
        ], 201);
    }

    /**
     * Search for children API
     */
    public function show(User $user)
    {

    }

    public function see(Department $department)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->account_type = $request->account_type;
        $user->department_id = $request->department_id;
        $user->section_id = $request-> section_id;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'data' => User::oldest()->get(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(200);
    }

    public function destroyAll(Request $request)
    {
        User::destroy($request->items);

        return response(200);
    }
}
