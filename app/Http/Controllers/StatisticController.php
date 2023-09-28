<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Survey;
use App\Models\Exam;

class StatisticController extends Controller
{
    public function index()
    {
        // $data = Survey::select('num_games_play', 'user_id')->orderBy('num_games_play', 'asc')->get();
        $data = Survey::orderBy('num_games_play', 'asc')->get();


        $abstractExam = Exam::select('id')->where('name', 'Abstract Reasoning Exam')->first();
        // Gamer

        $gamer = collect([
            'numGames' => collect(),
            'mobile' => collect(),
            'console' => collect(),
            'pc' => collect(),
            'shooter' => collect(),
            'actAdv' => collect(),
            'sims' => collect(),
            'moba' => collect(),
            'sports' => collect(),
            'race' => collect(),
            'strat' => collect(),
            'batRoy' => collect(),
            'puzzPlat' => collect(),
            'fight' => collect(),
            'board' => collect(),
            'absScore' => collect(),
            'female' => 0,
            'male' => 0,
        ]);
        // Non Gamer
        $nonGamer = collect([
            'numGames' => collect(),
            'mobile' => collect(),
            'console' => collect(),
            'pc' => collect(),
            'shooter' => collect(),
            'actAdv' => collect(),
            'sims' => collect(),
            'moba' => collect(),
            'sports' => collect(),
            'race' => collect(),
            'strat' => collect(),
            'batRoy' => collect(),
            'puzzPlat' => collect(),
            'fight' => collect(),
            'board' => collect(),
            'absScore' => collect(),
            'female' => 0,
            'male' => 0,
        ]);

        // all
        $all = collect([
            'numGames' => collect(),
            'mobile' => collect(),
            'console' => collect(),
            'pc' => collect(),
            'shooter' => collect(),
            'actAdv' => collect(),
            'sims' => collect(),
            'moba' => collect(),
            'sports' => collect(),
            'race' => collect(),
            'strat' => collect(),
            'batRoy' => collect(),
            'puzzPlat' => collect(),
            'fight' => collect(),
            'board' => collect(),
            'absScore' => collect(),
            'female' => 0,
            'male' => 0,
        ]);

        $data->each(function($item, $index) use(&$x, &$y, &$xy, $abstractExam, &$gamer, &$nonGamer, &$all) {

            $abs = $item->user->examAttempts()->where('exam_id', $abstractExam->id)->first();
            if (empty($abs)) {
                return true;
            }

            $all['numGames']->push($item->num_games_play);
            $all['mobile']->push($item->hrs_play_mobile);
            $all['console']->push($item->hrs_play_console);
            $all['pc']->push($item->hrs_play_pc);
            $all['shooter']->push($item->hrs_play_shooter);
            $all['actAdv']->push($item->hrs_play_act_adv);
            $all['sims']->push($item->hrs_play_sims);
            $all['moba']->push($item->hrs_play_moba);
            $all['sports']->push($item->hrs_play_sports);
            $all['race']->push($item->hrs_play_racing);
            $all['strat']->push($item->hrs_play_strat);
            $all['batRoy']->push($item->hrs_play_battle_royal);
            $all['puzzPlat']->push($item->hrs_play_puzzle_plat);
            $all['fight']->push($item->hrs_play_fighting);
            $all['board']->push($item->hrs_play_board);
            $all['absScore']->push($abs->score);
            if ($item->user->gender == 'male') {
                $all['male']+=1;
            }else{
                $all['female']+=1;
            }

            if ($item->is_gamer == 1) {
                $gamer['numGames']->push($item->num_games_play);
                $gamer['mobile']->push($item->hrs_play_mobile);
                $gamer['console']->push($item->hrs_play_console);
                $gamer['pc']->push($item->hrs_play_pc);
                $gamer['shooter']->push($item->hrs_play_shooter);
                $gamer['actAdv']->push($item->hrs_play_act_adv);
                $gamer['sims']->push($item->hrs_play_sims);
                $gamer['moba']->push($item->hrs_play_moba);
                $gamer['sports']->push($item->hrs_play_sports);
                $gamer['race']->push($item->hrs_play_racing);
                $gamer['strat']->push($item->hrs_play_strat);
                $gamer['batRoy']->push($item->hrs_play_battle_royal);
                $gamer['puzzPlat']->push($item->hrs_play_puzzle_plat);
                $gamer['fight']->push($item->hrs_play_fighting);
                $gamer['board']->push($item->hrs_play_board);
                $gamer['absScore']->push($abs->score);
                if ($item->user->gender == 'male') {
                    $gamer['male']+=1;
                }else{
                    $gamer['female']+=1;
                }

            }

            if ($item->is_gamer == 0) {
                $nonGamer['numGames']->push($item->num_games_play);
                $nonGamer['mobile']->push($item->hrs_play_mobile);
                $nonGamer['console']->push($item->hrs_play_console);
                $nonGamer['pc']->push($item->hrs_play_pc);
                $nonGamer['shooter']->push($item->hrs_play_shooter);
                $nonGamer['actAdv']->push($item->hrs_play_act_adv);
                $nonGamer['sims']->push($item->hrs_play_sims);
                $nonGamer['moba']->push($item->hrs_play_moba);
                $nonGamer['sports']->push($item->hrs_play_sports);
                $nonGamer['race']->push($item->hrs_play_racing);
                $nonGamer['strat']->push($item->hrs_play_strat);
                $nonGamer['batRoy']->push($item->hrs_play_battle_royal);
                $nonGamer['puzzPlat']->push($item->hrs_play_puzzle_plat);
                $nonGamer['fight']->push($item->hrs_play_fighting);
                $nonGamer['board']->push($item->hrs_play_board);
                $nonGamer['absScore']->push($abs->score);
                if ($item->user->gender == 'male') {
                    $nonGamer['male']+=1;
                }else{
                    $nonGamer['female']+=1;
                }
            }


        });
        // dd([$all, $gamer, $nonGamer]);
        return view('statistic.index',
        [
            // 'name' => 'Number of Games Played',
            'gamer' => $gamer->toJson(),
            'nonGamer' => $nonGamer->toJson(),
            'all' => $all->toJson()
        ]);
    }
}
