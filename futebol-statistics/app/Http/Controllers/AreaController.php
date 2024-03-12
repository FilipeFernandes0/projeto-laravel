<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function table(Request $request){
        $query = $request->input('query');
        $orderBy = $request->input('order_by', 'id'); // Default order by 'name'
        $orderDirection = $request->input('order_direction', 'asc'); // Default order direction 'asc'
    
        $areas = Area::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
        ->orderBy($orderBy, $orderDirection)
        ->paginate(50);
    
        return view("admin.area", [
            "areas" => $areas,
            "query" => $query,
            "order_by" => $orderBy,
            "order_direction" => $orderDirection,
        ]);
    }

    public function create(){

        

        return view("admin.areaCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new Area instance
        $area = new Area;
        
        // Assign values from the form data to the model properties
        $area->name = $request->input('name');
        // Assign other fields as needed

        // Save the new area entry to the database
        $area->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('area')->with('success', 'Area created successfully');
    }

    public function edit($id){
    $area = Area::findOrFail($id);
    return view('admin.areaEdit', compact('area'));
    }


    public function update(Request $request, $id){
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $area = Area::findOrFail($id);
    $area->name = $request->input('name');
    $area->save();

    return redirect()->route('area')->with('success', 'Area updated successfully');
}

public function destroy($id)
{
    $area = Area::findOrFail($id);
    $area->delete();

    return redirect()->route('area')->with('success', 'Area deleted successfully');
}





    }

