<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function table(Request $request){
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); 
        $orderDirection = $request->input('order_direction', 'asc'); 
    
        $seasons = Season::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('startDate', 'like', '%' . $query . '%')
                        ->orWhere('endDate', 'like', '%' . $query . '%')
                        ->orWhere('currentMatchday', 'like', '%' . $query . '%')
                        ->orWhere('winner', 'like', '%' . $query . '%')
                        ->orWhere('competition_id', 'like', '%' . $query . '%');
                });
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);
    
        return view("admin.seasons", [
            "seasons" => $seasons,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create(){

        

        return view("admin.seasonsCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'startDate' => 'required|string|max:255',
            'endDate' => 'required|string|max:255',
            'currentMatchday' => 'required|string|max:255',
            'winner' => 'required|string|max:255',
            'competition_id' => 'required|string|max:255',

        ]);

        // Create a new Area instance
        $seasons = new Season;
        
        // Assign values from the form data to the model properties
        $seasons->startDate = $request->input('startDate');
        $seasons->endDate = $request->input('endDate');
        $seasons->currentMatchday = $request->input('currentMatchday');
        $seasons->winner = $request->input('winner');
        $seasons->competition_id = $request->input('competition_id');



        // Assign other fields as needed

        // Save the new area entry to the database
        $seasons->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('seasons')->with('success', 'Season created successfully');
    }

    public function edit($id){
        $seasons = Season::findOrFail($id);
        return view('admin.seasonsEdit', compact('seasons'));
        }
    
    
        public function update(Request $request, $id){
        $request->validate([
            'startDate' => 'required|string|max:255',
            'endDate' => 'required|string|max:255',
            'currentMatchday' => 'required|string|max:255',
            'winner' => 'required|string|max:255',
            'competition_id' => 'required|string|max:255',

        ]);
    
        $seasons = Season::findOrFail($id);
        $seasons->startDate = $request->input('startDate');
        $seasons->endDate = $request->input('endDate');
        $seasons->currentMatchday = $request->input('currentMatchday');
        $seasons->winner = $request->input('winner');
        $seasons->competition_id = $request->input('competition_id');
        

        $seasons->save();
    
        return redirect()->route('seasons')->with('success', 'Season updated successfully');
    }

    public function destroy($id)
{
    $seasons = Season::findOrFail($id);
    $seasons->delete();

    return redirect()->route('seasons')->with('success', 'season deleted successfully');
}
}
