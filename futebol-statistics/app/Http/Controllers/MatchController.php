<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function table(Request $request){
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); 
        $orderDirection = $request->input('order_direction', 'asc'); 
    
        $matches = GameMatch::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('home_team_id', 'like', '%' . $query . '%')
                        ->orWhere('away_team_id', 'like', '%' . $query . '%')
                        ->orWhere('matchday', 'like', '%' . $query . '%')
                        ->orWhere('score', 'like', '%' . $query . '%')
                        ->orWhere('winner', 'like', '%' . $query . '%')
                        ->orWhere('competition_id', 'like', '%' . $query . '%');
                });
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);
    
        return view("admin.matches", [
            "matches" => $matches,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create(){

        

        return view("admin.matchesCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'home_team_id' => 'required|string|max:255',
            'away_team_id' => 'required|string|max:255',
            'matchday' => 'required|string|max:255',
            'score' => 'required|string|max:255',
            'winner' => 'required|string|max:255',
            'competition_id'=> 'required|string|max:255',

        ]);

        // Create a new Area instance
        $matches = new GameMatch;
        
        // Assign values from the form data to the model properties
        $matches->home_team_id = $request->input('home_team_id');
        $matches->away_team_id = $request->input('away_team_id');
        $matches->matchday = $request->input('matchday');
        $matches->score = $request->input('score');
        $matches->winner = $request->input('winner');
        $matches->competition_id = $request->input('competition_id');



        // Assign other fields as needed

        // Save the new area entry to the database
        $matches->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('matches')->with('success', 'Match created successfully');
    }

    public function edit($id){
        $matches = GameMatch::findOrFail($id);
        return view('admin.matchesEdit', compact('matches'));
        }
    
    
        public function update(Request $request, $id){
        $request->validate([
            'home_team_id' => 'required|string|max:255',
            'away_team_id' => 'required|string|max:255',
            'matchday' => 'required|string|max:255',
            'score' => 'required|string|max:255',
            'winner' => 'required|string|max:255',
            'competition_id'=> 'required|string|max:255',




        ]);
        $matches = GameMatch::findOrFail($id);
        $matches->home_team_id = $request->input('home_team_id');
        $matches->away_team_id = $request->input('away_team_id');
        $matches->matchday = $request->input('matchday');
        $matches->score = $request->input('score');
        $matches->winner = $request->input('winner');
        $matches->competition_id = $request->input('competition_id');


        $matches->save();
    
        return redirect()->route('matches')->with('success', 'Match updated successfully');
    }

    public function destroy($id)
{
    $matches = GameMatch::findOrFail($id);
    $matches->delete();

    return redirect()->route('matches')->with('success', 'Match deleted successfully');
}
}
