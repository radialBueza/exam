<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\GradeLevel;
use App\Models\Section;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class PickSection extends Controller
{
    public function index()
    {
        return view('section.pickSection', [
            'departments' => Department::all()->toJson(),
            'gradeLevels' => GradeLevel::all()->toJson(),
            'sections' => Section::all()->toJson()
        ]);
    }

    public function setSection(Request $request, User $user)
    {
        $request->validate([
            'section_id' => ['required', 'exists:sections,id']
        ]);
        $user->section_id = $request->section_id;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
