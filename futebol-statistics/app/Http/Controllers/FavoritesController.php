<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Favorite;
use App\Models\Team;
use App\Models\TeamsFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function showTeamFavorites()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view favorites.');
        }
    
        // Fetch favorite lists associated with the authenticated user
        $user = auth()->user();
        $favoriteLists = Favorite::where('user_id', $user->id)->get();

       
    
        // Fetch teams for each favorite list
        $response = [
            'favorites' => []
        ];
    
        foreach ($favoriteLists as $favoriteList) {
            $teamsFavorites = TeamsFavorite::where('favorite_id', $favoriteList->id)->get();
            $teams = [];
    
            foreach ($teamsFavorites as $teamFavorite) {
                $team = Team::find($teamFavorite->team_id);
                if ($team) {
                    $teams[] = $team;
                }
            }
    
            $response['favorites'][] = ['id' => $favoriteList->id, 'name' => $favoriteList->name, 'teams' => $teams];
        }
    
        return view('front.FavoritesTeams', compact('response', 'favoriteLists'));
    }
    
    public function updateFavoritesName(Request $request, $id)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to add favorites.');
    }

    // Find the favorite list by its ID
    $favoriteList = Favorite::findOrFail($id);

    // Check if the authenticated user is the owner of the favorite list
    
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Update the favorite list name
    $favoriteList->name = $request->input('name');
    $favoriteList->save();

    return redirect()->route('showTeamFavorites')->with('success', 'Favorite list updated successfully');
}


}
