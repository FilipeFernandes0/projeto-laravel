<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentClosure;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\Person;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontTeamsController extends Controller
{

    public function showAllTeams(Request $request)
    {
        $query = $request->input('query');
        $competition = $request->input('competition');


        $teams = Team::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
            ->when($competition, function ($queryBuilder) use ($competition) {
                return $queryBuilder->whereHas('competition', function ($competitionQuery) use ($competition) {
                    $competitionQuery->where('name', 'like', '%' . $competition . '%');
                });
            })

            ->paginate(10);

        $teams->appends(['query' => $query, 'competition' => $competition]);

        return view('front.showTeams', compact('teams', 'query'));
    }

    public function showTeamForCompetition(Request $request, $competitionId, $teamId)
    {

        $team = Team::where('teams_id', $teamId)->firstOrFail();

        $players = Person::where('team_id', $teamId)->get();

        $randomTeam = Team::inRandomOrder()->limit(6)->get();

        $comments = Comment::where('team_id', $teamId)->whereNull('parent_comment_id')->get(); //buscar comentarios onde o campo do pai e nulo

        $favoriteLists  = Favorite::all();






        return view('front.team_show', compact('team', 'players', 'competitionId', 'teamId', 'favoriteLists', 'randomTeam', 'comments'));
    }


    public function postTeamOnFavorites(Request $request, $competitionId, $teamId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add favorites.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $favorite = new Favorite;
        $favorite->name = $request->input('name');

        $favorite->user_id = Auth::id();


        $favorite->save();

        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Favorite created successfully');
    }

    public function storeToFavoriteList(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add favorites.');
        }

        // Get the authenticated user's favorite lists
        $user = auth()->user();
        $userFavoriteLists = Favorite::where('user_id', $user->id)->get();

        // Validate the form data
        $request->validate([
            'favorites_list_ids' => 'required|array',
        ]);

        // Get the team ID and selected favorite list IDs from the request
        $teamId = $request->input('team_id');
        $selectedFavoriteListIds = $request->input('favorites_list_ids');

        // Prevent duplicate associations and associate teams with favorite lists owned by the user
        foreach ($selectedFavoriteListIds as $favoriteListId) {
            // Check if the favorite list belongs to the authenticated user
            $user = auth()->user();
            $favoriteList = Favorite::where('user_id', $user->id)->get();
            // Find the Favorite model for the current favorite list ID
            $favoriteList = Favorite::findOrFail($favoriteListId);

            // Check if the team is already attached to the favorite list
            if (!$favoriteList->teams()->where('team_id', $teamId)->exists()) {
                // Attach the team to the favorite list only if it's not already attached
                $favoriteList->teams()->attach($teamId);
            }
        }


        return redirect()->back()->with('success', 'Team added to selected favorites lists successfully');
    }



    // public function updateTeamOnFavorites(Request $request, $competitionId, $teamId, $id)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'Please log in to add favorites.');
    //     }
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $favoriteLists = Favorite::findOrFail($id);
    //     $favoriteLists->name = $request->input('name');
    //     $favoriteLists->user_id = Auth::id();
    //     $favoriteLists->save();


    //     return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
    //         ->with('success', 'Favorites updated successfully');
    // }
    public function destroy($competitionId, $teamId, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add favorites.');
        }


        // Find the favorite list by its ID
        $favoriteLists = Favorite::findOrFail($id);

        if ($favoriteLists->user_id !== Auth::id()) {
            return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
                ->with('error', 'You are not authorized to remove from this favorite list.');
        }

        // Delete the favorite list
        $favoriteLists->teams()->detach($teamId);


        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Favorites deleted successfully');
    }


    public function commentForTeam(Request $request, $competitionId, $teamId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add Comments.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'text' =>  'required|string',
        ]);
        $comment = new Comment;

        $comment->title = $request->input('title');
        $comment->text = $request->input('text');
        $comment->team_id = $teamId;
        $comment->parent_comment_id = null; // For top-level comments

        $comment->user_id = Auth::id();

        $comment->save();

        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Comment created successfully');
    }

    public function replyToComment(Request $request, $competitionId, $teamId, $commentId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to reply to comments.');
        }

        // Validate the incoming request
        $request->validate([
            'text' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        // Find the parent comment
        $parentComment = Comment::findOrFail($commentId);

        // Create a new reply
        $reply = new Comment;
        $reply->title = $request->input('title');
        $reply->text = $request->input('text');
        $reply->team_id = $teamId;
        $reply->parent_comment_id = $parentComment->id; // Set the parent_comment_id to the ID of the parent comment


        $reply->user_id = Auth::id();
        $reply->save();

        // Create a new comment closure record to establish the hierarchical relationship
        $commentClosure = new CommentClosure;
        $commentClosure->ancestor_id = $parentComment->id;
        $commentClosure->descendant_id = $reply->id;
        $commentClosure->depth = $parentComment->depth + 1; // Assuming you have a 'depth' field in your Comment model
        $commentClosure->save();

        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Reply posted successfully');
    }

    public function updateComment(Request $request, $competitionId, $teamId, $commentId)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'text' =>  'required|string',
        ]);

        $comment = Comment::findOrFail($commentId);
        $comment->title = $request->input('title');
        $comment->text = $request->input('text');
        $comment->team_id = $teamId;
        $comment->parent_comment_id = null; // For top-level comments

        $comment->user_id = Auth::id();

        $comment->save();

        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Comment created successfully');
    }

    public function deleteComment($competitionId, $teamId, $commentId)
    {

        // Find the favorite list by its ID
        $comment = Comment::findOrFail($commentId);

        // Delete the favorite list
        $comment->delete();


        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Favorites deleted successfully');
    }

    public function storeLike(Request $request, $competitionId, $teamId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to like teams.');
        }

        // Check if the team already has a like from the user
        $team = Team::find($teamId);
        if (!$team) {
            return redirect()->back()->with('error', 'Team not found.');
        }


        // Create a new like
        $like = new Like;
        $like->user_id = Auth::id();
        $like->team_id = $teamId;
        $like->save();

        return redirect()->route('team_show', ['competitionId' => $competitionId, 'teamId' => $teamId])
            ->with('success', 'Team liked successfully');
    }

    public function unlikeTeam(Request $request, $competitionId, $teamId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to unlike teams.');
        }

        // Check if the team exists
        $team = Team::find($teamId);
        if (!$team) {
            return redirect()->back()->with('error', 'Team not found.');
        }

        // Remove the like
        Auth::user()->removeLikeFromTeam($team);

        return redirect()->back()->with('success', 'Team unliked successfully.');
    }

    public function likeComment(Request $request, $competitionId, $teamId, $commentId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to like comments.');
        }

        $comment = Comment::find($commentId);
        if (!$comment) {
            return redirect()->back()->with('error', 'Team not found.');
        }
        // Create a new like
        $like = new LikeComment;
        $like->user_id = Auth::id();
        $like->comment_id = $commentId;
        $like->save();

        return redirect()->back()->with('success', 'Comment liked successfully.');
    }

    // Unlike a comment
    public function unlikeComment(Request $request, $competitionId, $teamId, $commentId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to unlike comments.');
        }

        $comment = Comment::find($commentId);
        if (!$comment) {
            return redirect()->back()->with('error', 'Team not found.');
        }

        Auth::user()->removeLikeFromComment($comment);


        return redirect()->back()->with('success', 'Comment unliked successfully.');
    }
}
