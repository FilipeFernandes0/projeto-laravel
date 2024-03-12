<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\GameMatch;
use App\Models\Standing;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class FrontCompetitionController extends Controller
{


    public function index(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type');
        $country = $request->input('country');




        $competitions = Competition::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
            ->when($type, function ($queryBuilder) use ($type) {
                return $queryBuilder->where('type', $type);
            })->when($country, function ($queryBuilder) use ($country) {
                return $queryBuilder->whereHas('area', function ($areaQuery) use ($country) {
                    $areaQuery->where('name', 'like', '%' . $country . '%');
                });
            })
            ->paginate(4);


        $competitions->appends(['query' => $query, 'type' => $type, 'country' => $country]);


        return view('front.competitions', ["competitions" => $competitions]);
    }


    public function showMatchesForCompetition(Request $request, $competitionId)
{
    $searchQuery = $request->input('query');
    $matchday = $request->input('matchday');

    $matchesQuery = GameMatch::where('competition_id', $competitionId);

    // Adjust the query to show all matches if matchday is not set
    if (!$matchday) {
        $matchesQuery->whereDate('utc_date', '>=', Carbon::now());
    }

    if ($matchday) {
        $matchesQuery->where('matchday', $matchday);
    }

    if ($searchQuery) {
        $matchesQuery->where(function ($queryBuilder) use ($searchQuery) {
            $queryBuilder->whereHas('homeTeam', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            })
                ->orWhereHas('awayTeam', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%');
                });
        });
    }

    $matches = $matchesQuery->paginate(10);

    $matches->appends(['query' => $searchQuery, 'matchday' => $matchday]);

    $standings = Standing::where('competition_id', $competitionId)->get();

    $groupedStandings = $standings->groupBy('group');

    return view('front.matches_show', compact('matches', 'standings', 'groupedStandings', 'competitionId', 'searchQuery'));
}




    public function showTeamsForCompetition(Request $request, $competitionId)
    {



        $teams = Team::where('competition_id', $competitionId)->get();



        return view('front.teams_show', compact('teams'));
    }
}
