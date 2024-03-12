<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Contact;
use App\Models\GameMatch;
use App\Models\Person;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){

        $totalTeams = Team::count();

        $totalMatches = GameMatch::count();

        $totalPerson = Person::count();

        $totalSeason = Season::count();

        $competitions = Competition::all();

        foreach ($competitions as $competition) {
            $teamsCount = DB::table('teams')
                ->where('competition_id', $competition->competitions_id)
                ->count();
    
            $competition->teams_count = $teamsCount;
        }

        $messages = Contact::all();

        $matches = GameMatch::all();

        $teams = Team::all();

        foreach ($competitions as $competition) {
            $seasonsCount = DB::table('seasons')
                ->where('competition_id', $competition->competitions_id)
                ->count();
    
            $competition->seasons_count = $seasonsCount;
        }

      
    
        return view('admin.dashboard', compact(
            'totalTeams',
            'totalMatches',
            'totalPerson',
            'totalSeason',
            'competitions',
            'messages',
            'matches',
            'teams',
        ));
    }
    public function markAsRead($messageId)
    {
        $message = Contact::find($messageId);
        if ($message) {
            $message->is_read = true;
            $message->save();
            return response()->json(['message' => 'Message marked as read'], 200);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }
}
