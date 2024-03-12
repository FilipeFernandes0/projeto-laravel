@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Seasons Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('seasonsCreate') }}" class="btn btn-primary">Create new season</a>
        </div> 
        <form action="{{ route('seasons') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a></th>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'startDate', 'order_direction' => ($order_by == 'startDate' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Start Date</a></th>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'endDate', 'order_direction' => ($order_by == 'endDate' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">End Date</a></th>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'currentMatchday', 'order_direction' => ($order_by == 'currentMatchday' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Current Matchday</a></th>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'winner', 'order_direction' => ($order_by == 'winner' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Winner</a></th>
                        <th scope="col"><a href="{{ route('seasons', ['order_by' => 'competition_id', 'order_direction' => ($order_by == 'competition_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Competition ID</a></th>
                        <th scope="col"></th>
                


                        <th scope="col"></th>
                     


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seasons as $season)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seasonModal{{ $season->id }}">
                                    {{ $season->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="seasonModal{{ $season->id }}" tabindex="-1" aria-labelledby="seasonnModalLabel{{ $season->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="seasonModalLabel{{ $season->id }}" >Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" >
                                                <p>ID: {{ $season->id }}</p>
                                                <p>Start Date: {{ $season->startDate }}</p>
                                                <p>End Date: {{ $season->endDate }}</p>
                                                <p>Current Matchday: {{ $season->currentMatchday }}</p>
                                                <p>Winner: {{ $season->winner }}</p>
                                                <p>Competition ID: {{ $season->competition->name }}</p>

                                            </div> 
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $season->startDate }} </td>
                            <td> {{ $season->endDate }}</td>
                            <td>{{ $season->currentMatchday }} </td>
                            <td> {{ $season->winner }}</td>
                            <td>{{ $season->competition->name }} </td>

                            <td> 
                                <a href="{{ route('seasonsEdit', $season->id) }}" class="btn btn-primary mb-2">Edit</a>
                           
                                <form method="post" action="{{ route('seasonsDestroy', $season->id) }}" onsubmit="return confirm('Are you sure you want to delete this season?')">
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
                        <li class="page-item {{ $seasons->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $seasons->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $seasons->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $seasons->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $seasons->firstItem() }} to {{ $seasons->lastItem() }} of {{ $seasons->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
