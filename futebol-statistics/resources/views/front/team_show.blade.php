@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 mx-auto text-center">
                <h1 class="text-white">{{$team->name}}</h1>
                
                <p> {{$team->stadium}}
                <p> {{$team->founded}}
            </div>
        </div>
    </div>
</div>
<!-- Modal for favoriting -->
<div class="modal fade" id="favoriteModal" tabindex="-1" role="dialog" aria-labelledby="favoriteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="favoriteModalLabel">Add to Favorites</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new favorite list -->
                <form method="POST" action="{{ route('teamStore',  ['competitionId' => $competitionId, 'teamId' => $teamId]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="new_favorite_list_name">Create Favorite List:</label>
                        <input type="text" class="form-control" id="new_favorite_list_name" name="name" placeholder="Favorites List Name">
                    </div>
                    <button type="submit" class="btn btn-primary">Create New Favorites List</button>
                </form>
                
                <hr>

                <!-- Form for selecting an existing favorite list -->
                <form method="POST" action="{{ route('teamstoreToFavoriteList', ['competitionId' => $competitionId, 'teamId' => $teamId]) }}">
                    @csrf
                    <input type="hidden" name="team_id" value="{{ $teamId }}">
                    <div class="form-group">
                        <label>Favorite Lists:</label><br>
                        <select class="form-control" name="favorites_list_ids[]">

                            @foreach ($favoriteLists as $favoriteList)

                                <option class="bg-dark" value="{{ $favoriteList->id }}">{{ $favoriteList->name }}</option>
                              
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Selected Favorites List</button>
                </form>

                <!-- Form for updating a favorite list -->

                {{-- <button type="button" class="btn btn-primary btn-sm edit-comment mb-2" data-toggle="modal" data-target="#editFavoriteModal" data-favourite-id="{{ $favourite->id }}">
                    Edit
                </button> --}}
                {{-- @foreach ($favoriteLists as $favoriteList)
                <form method="POST" action="{{ route('updateTeamOnFavorites', ['competitionId' => $competitionId, 'teamId' => $teamId, $favoriteList->id ]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="update_favorite_list_name">Update Favorite List:</label>
                        <input type="text" class="form-control" id="update_favorite_list_name" name="name" value="{{ $favoriteList->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Favorites List</button>
                </form>
                @endforeach --}}

                <!-- Form for deleting a favorite list -->
                @foreach ($favoriteLists as $favoriteList)
                @if ($favoriteList->teams()->where('team_id', $teamId)->exists())
                    <form method="POST" action="{{ route('destroy', ['competitionId' => $competitionId, 'teamId' => $teamId, 'id' => $favoriteList->id]) }}" onsubmit="return confirm('Are you sure you want to remove the team from the favorite list??')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger mt-3"><span class="icon-trash-o" style="font-size: 20px;"></span></button>
                    </form>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</div>

{{-- edit comment modal --}}
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @foreach ($comments as $comment)

                <form id="editCommentForm" action="{{ route('updateComment', ['competitionId' => $competitionId, 'teamId' => $teamId, 'commentId' => $comment->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="comment_id" id="editCommentId">
                    <div class="form-group">
                        <label for="editCommentTitle">Title</label>
                        <input type="text" class="form-control" id="editCommentTitle" name="title" value="{{ $comment->title }}">
                    </div>
                    <div class="form-group">
                        <label for="editCommentText">Text</label>
                        <textarea class="form-control" id="editCommentText" name="text" value="{{ $comment->text }}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- edit favorite modal --}}

{{-- <div class="modal fade" id="editFavoritetModal" tabindex="-1" role="dialog" aria-labelledby="editFavoriteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="editFavoriteModalLabel">Edit Favorite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @foreach ($favoriteLists as $favoriteList)

                <form id="editFavoriteForm" method="POST" action="{{ route('updateTeamOnFavorites', ['competitionId' => $competitionId, 'teamId' => $teamId, $favoriteList->id ]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="update_favorite_list_name">Update Favorite List:</label>
                        <input type="text" class="form-control" id="update_favorite_list_name" name="name" value="{{ $favoriteList->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Favorites List</button>
                </form>
                @endforeach 

            </div>
        </div>
    </div>
</div> --}}








<div class="site-section first-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="widget-next-match">                        

                <table class="table custom-table table-responsive-lg"> 
                    <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($players as $player)
                            <tr>
                                <td class="text-white">{{$player->name}}</td>
                                <td class="text-white">{{$player->position}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
            </div>
            <div class="col-md-4 sidebar">
           
                <div class="sidebar-box">
                    <div class="categories">

                        <h3 class="text-uppercase">Favourite</h3>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#favoriteModal"><span class="icon-heart-o" style="font-size: 20px;"></span>
                        </button>
                        <h3 class="text-uppercase">Like this team</h3>
                        @if(Auth::check())
                        @if(Auth::user()->hasLikedTeam($team))
                            <form method="POST" action="{{ route('unlikeTeam', ['competitionId' => $competitionId, 'teamId' => $teamId]) }}" class="d-inline">
                                @csrf
                                @method('POST') <!-- Change to POST method -->
                                <button type="submit" class="btn btn-link"><span class="icon-favorite" style="font-size: 20px;"></span></button>
                            </form>
                            <span class="text-white">{{ Auth::user()->likesCount($team) }}</span> <!-- Display the likes count -->

                        @else
                            <form method="POST" action="{{ route('storeLike', ['competitionId' => $competitionId, 'teamId' => $teamId]) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link"><span class="icon-favorite_border" style="font-size: 20px;"></span></button>
                            </form>

                        @endif
                        @endif
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-6 title-section">
          <h2 class="heading"> More teams</h2>
        </div>
        <div class="col-6 text-right">
          <div class="custom-nav">
            <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
            <span></span>
            <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
          </div>
        </div>
      </div>
  
      <div class="owl-4-slider owl-carousel">
        @foreach($randomTeam as $team)
        <a href="{{ route('team_show', ['competitionId' => $competitionId, 'teamId' => $team->teams_id]) }}" class="item">
          <div class="item">
            <div class="team">
              <img src="{{$team->crest}}" alt="Image" class="img-fluid" style="max-width: 50%; height: auto; display: block; margin: 0 auto;">               
              
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
  

  <div class="pt-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($comments as $comment)
                <div class="card bg-dark text-light mb-3" style="max-width: 700px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="card-title">{{ $comment->user->name }}</h5>
                            @if(Auth::check() && $comment->user_id == Auth::id())
                            <!-- Edit button -->
                            <button type="button" class="btn btn-link p-0 edit-comment ml-2" data-toggle="modal" data-target="#editCommentModal" data-comment-id="{{ $comment->id }}">
                                <span class="icon-edit" style="font-size: 20px;"></span>
                            </button>
                            <!-- Delete button -->
                            <form method="POST" action="{{ route('deleteComment', ['competitionId' => $competitionId, 'teamId' => $teamId, 'commentId' => $comment->id]) }}" onsubmit="return confirm('Are you sure you want to delete this Comment?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link text-danger"><span class="icon-trash-o" style="font-size: 20px;"></span></button>
                            </form>
                            @endif
                        </div>

                        <h6 class="card-subtitle mb-2">title: {{ $comment->title }}</h6>
                        <p class="card-text mb-3">text: {{ $comment->text }}</p>

                        @if(Auth::check())
                        @if(Auth::user()->hasLikedComment($comment))
                            <form method="POST" action="{{ route('unlikeComment', ['competitionId' => $competitionId, 'teamId' => $teamId, 'commentId' => $comment->id]) }}" class="d-inline">
                                @csrf
                                @method('POST') <!-- Change to POST method -->
                                <button type="submit" class="btn btn-link"><span class="icon-favorite" style="font-size: 20px;"></span></button>
                            </form>
                            <span class="text-white">{{ Auth::user()->likesCommentCount($comment) }}</span> <!-- Display the likes count -->

                        @else
                            <form method="POST" action="{{ route('likeComment', ['competitionId' => $competitionId, 'teamId' => $teamId, 'commentId' => $comment->id]) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link"><span class="icon-favorite_border" style="font-size: 20px;"></span></button>
                            </form>

                        @endif
                        @endif

                        <!-- Reply form for this comment -->
                        <form action="{{ route('replyToComment', ['competitionId' => $competitionId, 'teamId' => $teamId, 'commentId' => $comment->id]) }}" method="POST" class="reply-form mb-3">
                            @csrf
                            <div class="form-group"> 
                                <input type="text" class="form-control" name="title" placeholder="Your title">
                            </div>
                            <div class="form-group"> 
                                <textarea name="text" class="form-control" placeholder="Your reply"></textarea>
                            </div>
                            <button type="submit" class="btn btn-link"><span class="icon-insert_comment" style="font-size: 20px;"></span></button>
                        </form>

                        <!-- Subcomments -->
                        <div class="subcomments">
                            @foreach ($comment->descendants as $reply)
                            <div class="comment-body mb-3">
                                <h6>{{ $reply->user->name }}</h6>
                                <h6>title: {{ $reply->title }}</h6>
                                <p>text: {{ $reply->text }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>













  
<!-- comment -->

<div class="comment-form-wrap pt-5">
  <h3 class="mb-5 ml-2">Leave a comment <span class="icon-commenting mr-2"></span></h3>
  <form method="POST" action="{{ route('commentForTeam', ['competitionId' => $competitionId, 'teamId' => $teamId]) }}" class="p-5 bg-light">
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    
    <div class="form-group">
      <label for="message">Message</label>
      <textarea name="text" id="message" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary py-3 px-4 text-white">
    </div>

  </form>
</div>
</div>



@endsection
