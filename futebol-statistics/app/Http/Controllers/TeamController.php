<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function table(Request $request)
    {
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); // Default order by 'name'
        $orderDirection = $request->input('order_direction', 'asc');


        $teams = Team::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%')
                        ->orWhere('founded', 'like', '%' . $query . '%')
                        ->orWhere('stadium', 'like', '%' . $query . '%');
                });
        })->orderBy($orderBy, $orderDirection)
        ->paginate(50);

        return view("admin.teams", [
            "teams" => $teams,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create()
    {



        return view("admin.teamsCreate");
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'founded' => 'required|string|max:255',
            'stadium' => 'required|string|max:255',

        ]);

        // Create a new Area instance
        $teams = new Team;

        // Assign values from the form data to the model properties
        $teams->name = $request->input('name');
        $teams->founded = $request->input('founded');
        $teams->stadium = $request->input('stadium');


        // Assign other fields as needed

        // Save the new area entry to the database
        $teams->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('teams')->with('success', 'Team created successfully');
    }

    public function edit($id)
    {
        $teams = Team::findOrFail($id);
        return view('admin.teamsEdit', compact('teams'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'founded' => 'required|string|max:255',
            'stadium' => 'required|string|max:255',


        ]);

        $teams = Team::findOrFail($id);
        $teams->name = $request->input('name');
        $teams->founded = $request->input('founded');
        $teams->stadium = $request->input('stadium');


        $teams->save();

        return redirect()->route('teams')->with('success', 'Team updated successfully');
    }

    public function destroy($id)
    {
        $teams = Team::findOrFail($id);
        $teams->delete();

        return redirect()->route('teams')->with('success', 'Team deleted successfully');
    }
}
