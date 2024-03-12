<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\GameMatch;
use App\Models\Standing;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    
    public function index() {

        $randomCompetition = Competition::inRandomOrder()->limit(3)->get();


        $competition = Competition::inRandomOrder()->first();

        $competitionId = $competition->competitions_id;

        // Retrieve standings associated with the random competition
        $randomStandings = Standing::where('competition_id', $competition->competitions_id)->get();
        $currentUTCDate = Carbon::now()->toDateTimeString();
        $randomMatch = GameMatch::where('utc_date', '>', $currentUTCDate)
                                ->inRandomOrder()
                                ->first();

        $randomTeam = Team::inRandomOrder()->limit(6)->get();


    
        // Pass the random standing and random match to the view
        return view('front.index', compact('randomMatch', 'randomStandings','randomCompetition', 'randomTeam', 'competitionId'));
    }
    

}
