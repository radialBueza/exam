<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\User;
use App\Http\Requests\SurveyRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;


class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $survey = collect([
            [
                'name' => 'num_games_play',
                'question' => 'How many video games do you play?',
                'answers' => ['Zero (0) games', 'One (1) game', 'Two (2) games', 'Three (3) games', 'Four (4) games', 'Five (5) games', 'Six (6) games or more']
            ],
            [
                'name' => 'hrs_play_mobile',
                'question' => 'On average, how many hours do you play games on mobile devices (e.g., smarthpones, tablets, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_console',
                'question' => 'On average, how many hours do you play games on console devices (e.g., Play Station 4, Xbox, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_pc',
                'question' => 'On average, how many hours do you play games on computer devices (e.g., laptops and desktops) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_shooter',
                'question' => 'On average, how many hours do you play Shooter Games (e.g., Valorant, COunter Strike: Global Offensive, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_act_adv',
                'question' => 'On average, how many hours do you play Action Adventure (e.g., Elden Ring, God of War: Ragnarok, Ghost of Tsushima, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_sims',
                'question' => 'On average, how many hours do you play Simulation Games (e.g., Sims 4, Animal Crossing: New Horizons, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_moba',
                'question' => 'On average, how many hours do you play MOBA Games (e.g., Dota 2, League of Legends, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_sports',
                'question' => 'On average, how many hours do you play Sports Games (e.g., NBA 2k23, Rocket League, FIFA 23, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_racing',
                'question' => 'On average, how many hours do you play Racing Games (e.g., Mario Kart 8, Real Racing 3, Asphalt 8: Airborne, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_strat',
                'question' => 'On average, how many hours do you play Strategy Games (e.g., Age of Empires 4, Starcraft 2, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_battle_royal',
                'question' => 'On average, how many hours do you play Battle Royale Games (e.g., Fornite, Apex Legends, Fall Guys: Ultimate Knockout, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_puzzle_plat',
                'question' => 'On average, how many hours do you play Puzzle Platform Games (e.g., Limbo, Portal 2, Unravel, Little Nightmares, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_fighting',
                'question' => 'On average, how many hours do you play Fighting Games (e.g., Street Fighter V, Marvel vs. Capcom: Infinite 2017, Tekken 7, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'hrs_play_board',
                'question' => 'On average, how many hours do you play Online Board Games (e.g., Chess, Monopoly, and more) in a day?',
                'answers' => ['0 minutes', '1 minute to 60 minutes (1 hour)', '61 minutes to 120 minutes (2 hours)', '121 minutes to 180 minutes (3 hours)', '181 minutes to 240 minutes (4 hours)', '241 minutes to 300 minutes (5 hours)', '301 minutes or more (more than 5 hours)']
            ],
            [
                'name' => 'is_gamer',
                'question' => 'Do you identify as a gamer?',
                'answers' => ['No', 'Yes']
            ],

        ]);

        return view('survey.create',
        [
            'surveys' => $survey->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyRequest $request, User $user)
    {
        $user->surveys()->create($request->validated());

        $user->take_survey = false;
        $user->save();

        return redirect(RouteServiceProvider::HOME);

    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        //
    }

    public function retake()
    {
        User::where('account_type', 'student')->update(['take_survey' => true]);

        return response()->json([
            // 'success' => true,
            'data' => User::oldest()->get(),
        ], 201);
    }

    public function retakeOne(User $user)
    {
        $user->take_survey = true;

        $user->save();

        return response(200);
    }
}
