<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ActiveExamResource;
use App\Models\Department;

class Dashboard extends Controller
{
    public function index()
    {
        if (Auth::user()->account_type === 'student') {
            if (Auth::user()->section_id == null ) {
                return redirect()->route('pickSection');
            }


            return view('dashboard.student',
            [
                'datas' => ActiveExamResource::collection(Auth::user()->section->gradeLevel->exams()->where('is_active', true)->get())->toJson(),
            ]);
        }

        return view('dashboard.dashboard');
    }
}
