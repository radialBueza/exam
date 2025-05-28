<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\StudentInfoResource;
use App\Http\Resources\ExamAttemptResource;
use App\Models\Subject;


class MyStudentController extends Controller
{
    public function index(Request $request) {
        if (empty($request->search)) {
            return $request->user()->section->users()->where('account_type', 'student')->get()->toJson();
        }
        $search = Str::lower($request->search);

        return $request->user()->section->users()->where(function (Builder $builder) use($search) {
            $builder->where('account_type', 'student');
            $builder->where('name', 'like', "%{$search}%");
            // $builder->orWhere('email', 'like', "%{$search}%");
        })->get();
    }

    public function all(Request $request) {
        return view('myStudent.index',
        [
            'datas' => $request->user()->section->users()->oldest()->where('account_type', 'student')->get()->toJson()
        ]);
    }

    public function show(Request $request, User $myStudents)
    {
        if (empty($request->search)) {
            return ExamAttemptResource::collection($myStudents->examAttempts);
        }
        $search = Str::lower($request->search);
        $subject = Subject::select('id')->where('name', 'like', "%{$search}%")->get();
        return ExamAttemptResource::collection($myStudents->examAttempts()->whereHas('exam', function(Builder $builder) use($subject, $search){
            $builder->whereIn('subject_id', $subject);
            $builder->orWhere('name', 'like', "%{$search}%");
        })->oldest()->get());

    }

    public function see(User $myStudents) {
        $survey = $myStudents->surveys()->latest()->first();
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
            'user' => new StudentInfoResource($myStudents),
            'datas' => ExamAttemptResource::collection($myStudents->examAttempts)->toJson(),
            'surveys' => $surveys->toJson(),
            // 'user' => $user
        ]);
    }
}
