@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Standings Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('standingsCreate') }}" class="btn btn-primary">Create new Standing</a>
        </div> 
        <form action="{{ route('standings') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'position', 'order_direction' => ($order_by == 'position' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Position</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'playedGames', 'order_direction' => ($order_by == 'playedGames' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Played Games</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'won', 'order_direction' => ($order_by == 'won' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Won</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'draw', 'order_direction' => ($order_by == 'draw' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Draw</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'lost', 'order_direction' => ($order_by == 'lost' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Lost</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'points', 'order_direction' => ($order_by == 'points' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Points</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'team_id', 'order_direction' => ($order_by == 'team_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Team ID</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'competition_id', 'order_direction' => ($order_by == 'competition_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">competition ID</a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'stage', 'order_direction' => ($order_by == 'stage' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Stage </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('standings', ['order_by' => 'group', 'order_direction' => ($order_by == 'competition_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Group</a>
                        </th>
                        <th scope="col"></th>


                       
                     


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standings as $standing)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standingModal{{ $standing->id }}">
                                    {{ $standing->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="standingModal{{ $standing->id }}" tabindex="-1" aria-labelledby="standingModalLabel{{ $standing->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="standingModalLabel{{ $standing->id }}">Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $standing->id }}</p>
                                                <p>Position: {{ $standing->position }}</p>
                                                <p>Played Games: {{ $standing->playedGames }}</p>
                                                <p>Won: {{ $standing->won }}</p>
                                                <p>Draw: {{ $standing->draw }}</p>
                                                <p>Lost: {{ $standing->lost }}</p>
                                                <p>Points: {{ $standing->points }}</p>
                                                <p>team ID: {{ $standing->team->name }}</p>
                                                <p>competition ID: {{ $standing->competition->name }}</p>
                                                <p>Stage: {{ $standing->stage }}</p>
                                                <p>Group: {{ $standing->group }}</p>


                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $standing->position }}</td>
                            <td>  {{ $standing->playedGames }}</td>
                            <td>{{ $standing->won }} </td>
                            <td> {{ $standing->draw }}</td>
                            <td>{{ $standing->lost }} </td>
                            <td>{{ $standing->points }} </td>
                            <td>{{ $standing->team->name }} </td>
                            <td>{{ $standing->competition->name }} </td>
                            <td>{{ $standing->stage }} </td>
                            <td>{{$standing->group }} </td>

                            <td> <a href="{{ route('standingsEdit', $standing->id) }}" class="btn btn-primary mb-2">Edit</a>
                            
                                <form method="post" action="{{ route('standingsDestroy', $standing->id) }}" onsubmit="return confirm('Are you sure you want to delete this standing?')">
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
                        <li class="page-item {{ $standings->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $standings->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $standings->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $standings->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $standings->firstItem() }} to {{ $standings->lastItem() }} of {{ $standings->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
