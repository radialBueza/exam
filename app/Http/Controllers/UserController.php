<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Section;
use App\Models\Subject;
use App\Models\GradeLevel;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use App\Http\Resources\ExamAttemptResource;
use App\Http\Resources\StudentInfoResource;
use App\Http\Resources\PersonnelResource;
use App\Http\Resources\ExamResource;
use Illuminate\Database\Eloquent\Builder;


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
        // return User::oldest()->where('name', 'like', "%{$search}%")->orWhere('account_type', 'like', "%{$search}%")->get();
        return User::oldest()->where(function (Builder $builder) use($search) {
            $builder->where('name', 'like', "%{$search}%");
            $builder->orWhere('account_type', 'like', "%{$search}%");
        })->get();
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

        $gender = collect();

        $gender->push((object)[
            'id' => 'male',
            'name' => 'Male'
        ]);

        $gender->push((object)[
            'id' => 'female',
            'name' => 'Female'
        ]);

        return view('user.index',
        [
            'datas' => User::oldest()->get()->toJson(),
            'options' => Department::all(),
            'sections' => Section::orderBy('grade_level_id', 'asc')->get(),
            'accountType' => $accountType->all(),
            'gender' => $gender->all()
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
            'section_id' => $request->section_id,
            'take_survey' => $request->take_survey,
            'gender' => $request->gender
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
    public function show(User $user, Request $request, string $type = '')
    {
        if ($user->account_type == 'student') {
            if (empty($request->search)) {
                return ExamAttemptResource::collection($user->examAttempts);
            }
            $search = Str::lower($request->search);
            $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
            return ExamAttemptResource::collection($user->examAttempts()->whereHas('exam', function(Builder $builder) use($subject, $search){
                $builder->whereIn('subject_id', $subject);
                $builder->orWhere('name', 'like', "%{$search}%");
            })->oldest()->get());
        }elseif ($user->account_type == 'teacher') {
            if (empty($request->search)) {
                return ExamResource::collection($user->exams()->oldest()->get());
            }

            $search = Str::lower($request->search);
            $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
            $gradeLevel = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();
            return ExamResource::collection($user->exams()->where(function (Builder $builder) use($search, $subject, $gradeLevel) {
                    $builder->where('name', 'like', "%{$search}%");
                    $builder->orWhere('description', 'like', "%{$search}%");
                    $builder->orWhereIn('subject_id', $subject);
                    $builder->orWhereIn('grade_level_id', $gradeLevel);
                })->get());
        }else {
            if (empty($request->search)) {
                if ($type == 'exams') {
                    return ExamResource::collection($user->exams()->oldest()->get());
                }else {
                    return $user->section->users()->where('account_type', 'student')->get()->toJson();
                }
            }
            $search = Str::lower($request->search);
            $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
            $gradeLevel = GradeLevel::select('id')->where('name', 'like', "%{$search}%")->get();
            if ($type == 'exams') {
                return ExamResource::collection($user->exams()->where(function (Builder $builder) use($search, $subject, $gradeLevel) {
                    $builder->where('name', 'like', "%{$search}%");
                    $builder->orWhere('description', 'like', "%{$search}%");
                    $builder->orWhereIn('subject_id', $subject);
                    $builder->orWhereIn('grade_level_id', $gradeLevel);
                })->get());
            }

            if ($type == 'students') {
                return $user->section->users()->where('account_type', 'student')->where(function (Builder $builder) use($search) {
                    $builder->where('name', 'like', "%{$search}%");
                    $builder->orWhere('email', 'like', "%{$search}%");
                })->get();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function see(User $user)
    {
        if ($user->account_type == 'student') {

            $survey = $user->surveys()->latest()->first();
            if (!empty($survey)) {
                $surveys = collect([
                    [
                        'id' => 1,
                        'name' => 'Number of Game(s) Played',
                        'a' => $survey->num_games_play !== 0 ? false : true,
                        'b' => $survey->num_games_play !== 1 ? false : true,
                        'c' => $survey->num_games_play !== 2 ? false : true,
                        'd' => $survey->num_games_play !== 3 ? false : true,
                        'e' => $survey->num_games_play !== 4 ? false : true,
                        'f' => $survey->num_games_play !== 5 ? false : true,
                        'g' => $survey->num_games_play !== 6 ? false : true,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Average Playtime on Mobile in a day',
                        'a' => $survey->hrs_play_mobile !== 0 ? false : true,
                        'b' => $survey->hrs_play_mobile !== 1 ? false : true,
                        'c' => $survey->hrs_play_mobile !== 2 ? false : true,
                        'd' => $survey->hrs_play_mobile !== 3 ? false : true,
                        'e' => $survey->hrs_play_mobile !== 4 ? false : true,
                        'f' => $survey->hrs_play_mobile !== 5 ? false : true,
                        'g' => $survey->hrs_play_mobile !== 6 ? false : true,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Average Playtime on Console in a day',
                        'a' => $survey->hrs_play_console !== '0' ? false : true,
                        'b' => $survey->hrs_play_console !== '1' ? false : true,
                        'c' => $survey->hrs_play_console !== '2' ? false : true,
                        'd' => $survey->hrs_play_console !== '3' ? false : true,
                        'e' => $survey->hrs_play_console !== '4' ? false : true,
                        'f' => $survey->hrs_play_console !== '5' ? false : true,
                        'g' => $survey->hrs_play_console !== '6' ? false : true,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Average Playtime on Computer Device in a day',
                        'a' => $survey->hrs_play_pc !== 0 ? false : true,
                        'b' => $survey->hrs_play_pc !== 1 ? false : true,
                        'c' => $survey->hrs_play_pc !== 2 ? false : true,
                        'd' => $survey->hrs_play_pc !== 3 ? false : true,
                        'e' => $survey->hrs_play_pc !== 4 ? false : true,
                        'f' => $survey->hrs_play_pc !== 5 ? false : true,
                        'g' => $survey->hrs_play_pc !== 6 ? false : true,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Average Playtime on Shooter Games in a day',
                        'a' => $survey->hrs_play_shooter !== 0 ? false : true,
                        'b' => $survey->hrs_play_shooter !== 1 ? false : true,
                        'c' => $survey->hrs_play_shooter !== 2 ? false : true,
                        'd' => $survey->hrs_play_shooter !== 3 ? false : true,
                        'e' => $survey->hrs_play_shooter !== 4 ? false : true,
                        'f' => $survey->hrs_play_shooter !== 5 ? false : true,
                        'g' => $survey->hrs_play_shooter !== 6 ? false : true,
                    ],
                    [
                        'id' => 6,
                        'name' => 'Average Playtime on Action Adventure in a day',
                        'a' => $survey->hrs_play_act_adv !== 0 ? false : true,
                        'b' => $survey->hrs_play_act_adv !== 1 ? false : true,
                        'c' => $survey->hrs_play_act_adv !== 2 ? false : true,
                        'd' => $survey->hrs_play_act_adv !== 3 ? false : true,
                        'e' => $survey->hrs_play_act_adv !== 4 ? false : true,
                        'f' => $survey->hrs_play_act_adv !== 5 ? false : true,
                        'g' => $survey->hrs_play_act_adv !== 6 ? false : true,
                    ],
                    [
                        'id' => 7,
                        'name' => 'Average Playtime on Simulation Games in a day',
                        'a' => $survey->hrs_play_sims !== 0 ? false : true,
                        'b' => $survey->hrs_play_sims !== 1 ? false : true,
                        'c' => $survey->hrs_play_sims !== 2 ? false : true,
                        'd' => $survey->hrs_play_sims !== 3 ? false : true,
                        'e' => $survey->hrs_play_sims !== 4 ? false : true,
                        'f' => $survey->hrs_play_sims !== 5 ? false : true,
                        'g' => $survey->hrs_play_sims !== 6 ? false : true,
                    ],
                    [
                        'id' => 8,
                        'name' => 'Average Playtime on MOBA Games in a day',
                        'a' => $survey->hrs_play_moba !== 0 ? false : true,
                        'b' => $survey->hrs_play_moba !== 1 ? false : true,
                        'c' => $survey->hrs_play_moba !== 2 ? false : true,
                        'd' => $survey->hrs_play_moba !== 3 ? false : true,
                        'e' => $survey->hrs_play_moba !== 4 ? false : true,
                        'f' => $survey->hrs_play_moba !== 5 ? false : true,
                        'g' => $survey->hrs_play_moba !== 6 ? false : true,
                    ],
                    ['id' => 9,
                        'name' => 'Average Playtime on Sports Games in a day',
                        'a' => $survey->hrs_play_sports !== 0 ? false : true,
                        'b' => $survey->hrs_play_sports !== 1 ? false : true,
                        'c' => $survey->hrs_play_sports !== 2 ? false : true,
                        'd' => $survey->hrs_play_sports !== 3 ? false : true,
                        'e' => $survey->hrs_play_sports !== 4 ? false : true,
                        'f' => $survey->hrs_play_sports !== 5 ? false : true,
                        'g' => $survey->hrs_play_sports !== 6 ? false : true,
                    ],
                    [
                        'id' => 10,
                        'name' => 'Average Playtime on Racing Games in a day',
                        'a' => $survey->hrs_play_racing !== 0 ? false : true,
                        'b' => $survey->hrs_play_racing !== 1 ? false : true,
                        'c' => $survey->hrs_play_racing !== 2 ? false : true,
                        'd' => $survey->hrs_play_racing !== 3 ? false : true,
                        'e' => $survey->hrs_play_racing !== 4 ? false : true,
                        'f' => $survey->hrs_play_racing !== 5 ? false : true,
                        'g' => $survey->hrs_play_racing !== 6 ? false : true,
                    ],
                    [
                        'id' => 11,
                        'name' => 'Average Playtime on Strategy Games in a day',
                        'a' => $survey->hrs_play_strat !== 0 ? false : true,
                        'b' => $survey->hrs_play_strat !== 1 ? false : true,
                        'c' => $survey->hrs_play_strat !== 2 ? false : true,
                        'd' => $survey->hrs_play_strat !== 3 ? false : true,
                        'e' => $survey->hrs_play_strat !== 4 ? false : true,
                        'f' => $survey->hrs_play_strat !== 5 ? false : true,
                        'g' => $survey->hrs_play_strat !== 6 ? false : true,
                    ],
                    [
                        'id' => 12,
                        'name' => 'Average Playtime on Royale Games in a day',
                        'a' => $survey->hrs_play_battle_royal !== 0 ? false : true,
                        'b' => $survey->hrs_play_battle_royal !== 1 ? false : true,
                        'c' => $survey->hrs_play_battle_royal !== 2 ? false : true,
                        'd' => $survey->hrs_play_battle_royal !== 3 ? false : true,
                        'e' => $survey->hrs_play_battle_royal !== 4 ? false : true,
                        'f' => $survey->hrs_play_battle_royal !== 5 ? false : true,
                        'g' => $survey->hrs_play_battle_royal !== 6 ? false : true,
                    ],
                    [
                        'id' => 13,
                        'name' => 'Average Playtime on Puzzle Platform Games in a day',
                        'a' => $survey->hrs_play_puzzle_plat !== 0 ? false : true,
                        'b' => $survey->hrs_play_puzzle_plat !== 1 ? false : true,
                        'c' => $survey->hrs_play_puzzle_plat !== 2 ? false : true,
                        'd' => $survey->hrs_play_puzzle_plat !== 3 ? false : true,
                        'e' => $survey->hrs_play_puzzle_plat !== 4 ? false : true,
                        'f' => $survey->hrs_play_puzzle_plat !== 5 ? false : true,
                        'g' => $survey->hrs_play_puzzle_plat !== 6 ? false : true,
                    ],
                    [
                        'id' => 14,
                        'name' => 'Average Playtime on Fighting Games in a day',
                        'a' => $survey->hrs_play_fighting !== 0 ? false : true,
                        'b' => $survey->hrs_play_fighting !== 1 ? false : true,
                        'c' => $survey->hrs_play_fighting !== 2 ? false : true,
                        'd' => $survey->hrs_play_fighting !== 3 ? false : true,
                        'e' => $survey->hrs_play_fighting !== 4 ? false : true,
                        'f' => $survey->hrs_play_fighting !== 5 ? false : true,
                        'g' => $survey->hrs_play_fighting !== 6 ? false : true,
                    ],
                    [
                        'id' => 15,
                        'name' => 'Average Playtime on Online Board Games in a day',
                        'a' => $survey->hrs_play_board !== 0 ? false : true,
                        'b' => $survey->hrs_play_board !== 1 ? false : true,
                        'c' => $survey->hrs_play_board !== 2 ? false : true,
                        'd' => $survey->hrs_play_board !== 3 ? false : true,
                        'e' => $survey->hrs_play_board !== 4 ? false : true,
                        'f' => $survey->hrs_play_board !== 5 ? false : true,
                        'g' => $survey->hrs_play_board !== 6 ? false : true,
                    ]
                ]);
            }else {
                $surveys = collect();
            }
            return view('user.student.show',
            [
                'user' => new StudentInfoResource($user),
                'datas' => ExamAttemptResource::collection($user->examAttempts)->toJson(),
                'surveys' => $surveys->toJson(),
            ]);
        }elseif ($user->account_type == 'teacher') {
            return view('user.adminAdvisorTeacher.show',
            [
                'user' => new PersonnelResource($user),
                'datas' => ExamResource::collection($user->exams()->oldest()->get())->toJson(),
            ]);
        }else {
            return view('user.adminAdvisorTeacher.show',
            [
                'user' => new PersonnelResource($user),
                'datas' => ExamResource::collection($user->exams()->oldest()->get())->toJson(),
                'students' => $user->section->users()->where('account_type', 'student')->get()->toJson()
            ]);
        }

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
        $user->section_id = $request->section_id;
        $user->take_survey = $request->take_survey;

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
