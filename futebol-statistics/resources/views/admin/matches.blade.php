@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Matches Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('matchesCreate') }}" class="btn btn-primary">Create new matches</a>
        </div> 
        <form action="{{ route('matches') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'home_team_id', 'order_direction' => ($order_by == 'home_team_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Home Team ID</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'away_team_id', 'order_direction' => ($order_by == 'away_team_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Away Team ID</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'matchday', 'order_direction' => ($order_by == 'matchday' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Matchday</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'score', 'order_direction' => ($order_by == 'score' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Score</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'winner', 'order_direction' => ($order_by == 'winner' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Winner</a></th>
                        <th scope="col"><a href="{{ route('matches', ['order_by' => 'competition_id', 'order_direction' => ($order_by == 'competition_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">competition Id</a></th>

                        <th scope="col"></th>





                        <th scope="col"></th>
                        


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matches as $match)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#matchModal{{ $match->id }}">
                                    {{ $match->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="matchModal{{ $match->id }}" tabindex="-1" aria-labelledby="matchModalLabel{{ $match->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="matchModalLabel{{ $match->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $match->id }}</p>
                                                <p>Home Team ID: {{ $match->homeTeam->name }}</p>
                                                <p>Away Team ID: {{ $match->awayTeam->name }}</p>
                                                <p>Matchday: {{ $match->matchday }}</p>
                                                <p>Score: {{ $match->score }}</p>
                                                <p>Winner: {{ $match->winner }}</p>
                                                <p>Winner: {{ $match->competition->name }}</p>


                                            </div>
                                            <div class="modal-footer  border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $match->homeTeam->name }} </td>
                            <td>{{ $match->awayTeam->name }} </td>
                            <td>{{ $match->matchday }} </td>
                            <td>{{ $match->score }} </td>
                            <td>{{ $match->winner }} </td>
                            <td>{{ $match->competition->name }} </td>

                            <td> 
                                <a href="{{ route('matchesEdit', $match->id) }}" class="btn btn-primary mb-2">Edit</a>
                         
                                <form method="post" action="{{ route('matchesDestroy', $match->id) }}" onsubmit="return confirm('Are you sure you want to delete this match?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item {{ $matches->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $matches->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $matches->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $matches->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $matches->firstItem() }} to {{ $matches->lastItem() }} of {{ $matches->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
