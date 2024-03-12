<?php

namespace App\Http\Controllers;

use App\Models\Standing;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function table(Request $request) {
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); // Default order by 'position'
        $orderDirection = $request->input('order_direction', 'asc'); // Default order direction 'asc'
    
        $standings = Standing::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('position', 'like', '%' . $query . '%')
                        ->orWhere('playedGames', 'like', '%' . $query . '%')
                        ->orWhere('won', 'like', '%' . $query . '%')
                        ->orWhere('draw', 'like', '%' . $query . '%')
                        ->orWhere('lost', 'like', '%' . $query . '%')
                        ->orWhere('points', 'like', '%' . $query . '%')
                        ->orWhere('team_id', 'like', '%' . $query . '%')
                        ->orWhere('competition_id', 'like', '%' . $query . '%')
                        ->orWhere('stage', 'like', '%' . $query . '%')
                        ->orWhere('group', 'like', '%' . $query . '%');


                });
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);
    
        return view("admin.standings", [
            "standings" => $standings,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create(){

        

        return view("admin.standingsCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'position' => 'required|string|max:255',
            'playedGames' => 'required|string|max:255',
            'won' => 'required|string|max:255',
            'draw' => 'required|string|max:255',
            'lost' => 'required|string|max:255',
            'points' => 'required|string|max:255',
            'team_id' => 'required|string|max:255',
            'competition_id' => 'required|string|max:255',
            'stage' => 'required|string|max:255',
            'group' => 'required|string|max:255',




        ]);

        // Create a new Area instance
        $standings = new Standing;
        
        // Assign values from the form data to the model properties
        $standings->position = $request->input('position');
        $standings->playedGames = $request->input('playedGames');
        $standings->won = $request->input('won');
        $standings->draw = $request->input('draw');
        $standings->lost = $request->input('lost');
        $standings->points = $request->input('points');
        $standings->team_id = $request->input('team_id');
        $standings->competition_id = $request->input('competition_id');
        $standings->stage = $request->input('stage');
        $standings->group = $request->input('group');






        // Assign other fields as needed

        // Save the new area entry to the database
        $standings->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('standings')->with('success', 'Standing created successfully');
    }

    public function edit($id){
        $standings = Standing::findOrFail($id);
        return view('admin.standingsEdit', compact('standings'));
        }
    
    
        public function update(Request $request, $id){
        $request->validate([
            'position' => 'required|string|max:255',
            'playedGames' => 'required|string|max:255',
            'won' => 'required|string|max:255',
            'draw' => 'required|string|max:255',
            'lost' => 'required|string|max:255',
            'points' => 'required|string|max:255',
            'team_id' => 'required|string|max:255',
            'competition_id' => 'required|string|max:255',
            'stage' => 'required|string|max:255',
            'group' => 'required|string|max:255',




        ]);
    
        $standings = Standing::findOrFail($id);
        $standings->position = $request->input('position');
        $standings->playedGames = $request->input('playedGames');
        $standings->won = $request->input('won');
        $standings->draw = $request->input('draw');
        $standings->lost = $request->input('lost');
        $standings->points = $request->input('points');
        $standings->team_id = $request->input('team_id');
        $standings->competition_id = $request->input('competition_id');
        $standings->stage = $request->input('stage');
        $standings->group = $request->input('group');


        $standings->save();
    
        return redirect()->route('standings')->with('success', 'Standing updated successfully');
    }

    public function destroy($id)
{
    $standings = Standing::findOrFail($id);
    $standings->delete();

    return redirect()->route('standings')->with('success', 'Standing deleted successfully');
}
}
