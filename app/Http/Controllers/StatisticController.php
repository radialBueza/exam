<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Survey;
use App\Models\Exam;

class StatisticController extends Controller
{
    private $datas = [
            'numGames' => 'Number of Games Played',
            'mobile' => 'Daily Mobile Playtime',
            'console' => 'Daily Console Playtime',
            'pc' => 'Daily Computer Playtime',
            'shooter' => 'Daily Shooter Game Playtime',
            'actAdv' => 'Daily Action and Adventure Game Playtime',
            'sims' => 'Daily Simulation Game Playtime',
            'moba' => 'Daily MOBA Game Playtime',
            'sports' => 'Daily Sports Game Playtime',
            'race' => 'Daily Racing Game Playtime',
            'strat' => 'Daily Strategy Game Playtime',
            'batRoy' => 'Daily Battle Royal Game Playtime',
            'puzzPlat' => 'Daily Puzzle Platform Game Playtime',
            'fight' => 'Daily Fighting Game Playtime',
            'board' => 'Daily Online Board Game Playtime',
        ];
    private function datas() {
        $data = Survey::with('user.examAttempts') // eager-load for performance
            ->orderBy('num_games_play', 'asc')
            ->get();

        $abstractExam = Exam::where('name', 'Abstract Reasoning Exam')->first();
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

        // $data->each(function($item, $index) use(&$x, &$y, &$xy, $abstractExam, &$gamer, &$nonGamer, &$all) {
        $data->each(function($item) use($abstractExam, &$gamer, &$nonGamer, &$all) {


            $abs = $item->user->examAttempts()->where('exam_id', $abstractExam->id)->latest()->first();
            if (empty($abs)) {
                return true;
            }

            $targets = [$all];
            if ($item->is_gamer) $targets[] = &$gamer;
            else $targets[] = &$nonGamer;

            foreach ($targets as &$group) {
                $group['numGames']->push($item->num_games_play);
                $group['mobile']->push($item->hrs_play_mobile);
                $group['console']->push($item->hrs_play_console);
                $group['pc']->push($item->hrs_play_pc);
                $group['shooter']->push($item->hrs_play_shooter);
                $group['actAdv']->push($item->hrs_play_act_adv);
                $group['sims']->push($item->hrs_play_sims);
                $group['moba']->push($item->hrs_play_moba);
                $group['sports']->push($item->hrs_play_sports);
                $group['race']->push($item->hrs_play_racing);
                $group['strat']->push($item->hrs_play_strat);
                $group['batRoy']->push($item->hrs_play_battle_royal);
                $group['puzzPlat']->push($item->hrs_play_puzzle_plat);
                $group['fight']->push($item->hrs_play_fighting);
                $group['board']->push($item->hrs_play_board);
                $group['absScore']->push($abs->score);

                $gender = strtolower($item->user->gender);
                if ($gender === 'male') $group['male'] += 1;
                else if ($gender === 'female') $group['female'] += 1;
            }

        });

        return ['gamer'=>$gamer, 'nonGamer' => $nonGamer, 'all' => $all];
    }

    public function index()
    {

        $result = $this->datas();
        // dd($result['gamer']);
        return view('statistic.index',
        [
            // 'name' => 'Number of Games Played',
            // 'gamer' => $gamer->toJson(),
            // 'nonGamer' => $nonGamer->toJson(),
            // 'all' => $all->toJson()
            'gamer' => $result['gamer']->toJson(),
            'nonGamer' => $result['nonGamer']->toJson(),
            'all' => $result['all']->toJson(),
            'datas' => $this->datas
        ]);
    }

    public function pdfCorrelation() {
        $result = $this->datas();
        return view('pdf.correlation', [
            'gamer' => $result['gamer']->toJson(),
            'nonGamer' => $result['nonGamer']->toJson(),
            'all' => $result['all']->toJson(),
            'datas' => $this->datas
        ]);
    }

    public function pdfGamerVsNongamer() {
        $result = $this->datas();
        return view('pdf.correlation', [
            'gamer' => $result['gamer']->toJson(),
            'nonGamer' => $result['nonGamer']->toJson(),
            'all' => $result['all']->toJson(),
            'datas' => $this->datas
        ]);
    }

    public function pdfMaleVsFemale() {
        $result = $this->datas();
        return view('pdf.correlation', [
            'gamer' => $result['gamer']->toJson(),
            'nonGamer' => $result['nonGamer']->toJson(),
            'all' => $result['all']->toJson(),
            'datas' => $this->datas
        ]);
    }

    public function pdfFrequency() {
        $result = $this->datas();
        return view('pdf.correlation', [
            'gamer' => $result['gamer']->toJson(),
            'nonGamer' => $result['nonGamer']->toJson(),
            'all' => $result['all']->toJson(),
            'datas' => $this->datas
        ]);
    }
}
