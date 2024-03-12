<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function table(Request $request){
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); // Default order by 'name'
        $orderDirection = $request->input('order_direction', 'asc');

        $persons = Person::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%')
                        ->orWhere('position', 'like', '%' . $query . '%')
                        ->orWhere('team_id', 'like', '%' . $query . '%');
                });
        }) 
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);

        return view("admin.persons", [
            "persons"=> $persons,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,]);

    }

    public function create(){

        

        return view("admin.personsCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'team_id' => 'required|string|max:255',

        ]);

        // Create a new Area instance
        $persons = new Person;
        
        // Assign values from the form data to the model properties
        $persons->name = $request->input('name');
        $persons->position = $request->input('position');
        $persons->team_id = $request->input('team_id');


        // Assign other fields as needed

        // Save the new area entry to the database
        $persons->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('persons')->with('success', 'Person created successfully');
    }

    public function edit($id){
        $persons = Person::findOrFail($id);
        return view('admin.personsEdit', compact('persons'));
        }
    
    
        public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'team_id' => 'required|string|max:255',

        ]);
    
        $persons = Person::findOrFail($id);
        $persons->name = $request->input('name');
        $persons->position = $request->input('position');
        $persons->team_id = $request->input('team_id');



        $persons->save();
    
        return redirect()->route('persons')->with('success', 'Person updated successfully');
    }

    public function destroy($id)
{
    $persons = Person::findOrFail($id);
    $persons->delete();

    return redirect()->route('persons')->with('success', 'Person deleted successfully');
}
}
