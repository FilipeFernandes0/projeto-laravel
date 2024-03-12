<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function table(Request $request){
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); 
        $orderDirection = $request->input('order_direction', 'asc'); 
    
        $competitions = Competition::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%')
                        ->orWhere('type', 'like', '%' . $query . '%')
                        ->orWhere('area_id', 'like', '%' . $query . '%');
                });
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);
    
        return view("admin.competition", [
            "competitions" => $competitions,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create(){

        

        return view("admin.competitionCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'area_id' => 'required|string|max:255',

        ]);

        // Create a new Area instance
        $competition = new Competition;
        
        // Assign values from the form data to the model properties
        $competition->name = $request->input('name');
        $competition->type = $request->input('type');
        $competition->area_id = $request->input('area_id');


        // Assign other fields as needed

        // Save the new area entry to the database
        $competition->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('competition')->with('success', 'Competition created successfully');
    }

    public function edit($id){
        $competition = Competition::findOrFail($id);
        return view('admin.competitionEdit', compact('competition'));
        }
    
    
        public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'area_id' => 'required|string|max:255',

        ]);
    
        $competition = Competition::findOrFail($id);
        $competition->name = $request->input('name');
        $competition->type = $request->input('type');
        $competition->area_id = $request->input('area_id');

        $competition->save();
    
        return redirect()->route('competition')->with('success', 'Competition updated successfully');
    }

    public function destroy($id)
{
    $competition = Competition::findOrFail($id);
    $competition->delete();

    return redirect()->route('competition')->with('success', 'Competition deleted successfully');
}

    

}
