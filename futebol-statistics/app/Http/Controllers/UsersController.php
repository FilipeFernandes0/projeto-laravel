<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function table(Request $request){

        $query = $request->input('query');


        $users = User::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder
                ->where(function ($innerQueryBuilder) use ($query) {
                    $innerQueryBuilder->where('name', 'like', '%' . $query . '%')
                        ->orWhere('username', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('is_admin', 'like', '%' . $query . '%');

                });
        })->paginate(50);

        return view("admin.users", ["users"=> $users, "query" => $query]);

    }

    public function create(){

        

        return view("admin.usersCreate");

    }

    public function store(Request $request){
        
        $request->validate([
            'name' =>'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email'=> 'required|email|max:255|unique:users,email',
            'password'=> 'required|min:7|max:255',

        ]);
       
        // Create a new Area instance
        $users = new User;
        // Assign values from the form data to the model properties
        $users->name = $request->input('name');
        $users->username = $request->input('username');
        $users->email = $request->input('email');
        if ($request->filled('password')) {
            $users->password = $request->input('password');
        }
        $users->is_admin = $request->has('is_admin') ? 1 : 0;

      
       
        

        // Assign other fields as needed

        // Save the new area entry to the database
        $users->save();


        // Redirect to a view or route after successful creation
        return redirect()->route('users')->with('success', 'user created successfully');
    }

    public function edit($id){
        $users = User::findOrFail($id);
        return view('admin.usersEdit', compact('users'));
        }
    
    
        public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|max:255|min:3|unique:users,username,' . $id,
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'password' => 'min:7|max:255',
    ]);

    $users = User::findOrFail($id);
    $users->name = $request->input('name');
    $users->username = $request->input('username');
    $users->email = $request->input('email');

    // Only update the password if provided
    if ($request->filled('password')) {
        $users->password = $request->input('password');
    }
    $users->is_admin = $request->has('is_admin') ? 1 : 0;

    $users->save();

    return redirect()->route('users')->with('success', 'user updated successfully');
}
    public function destroy($id)
{
    $users = User::findOrFail($id);
    $users->delete();

    return redirect()->route('users')->with('success', 'user deleted successfully');
}

}
