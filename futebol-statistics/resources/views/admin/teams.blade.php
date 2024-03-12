@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Teams Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('teamsCreate') }}" class="btn btn-primary">Create new Team</a>
        </div> 
        <form action="{{ route('teams') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="{{ route('teams', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a></th>
                        <th scope="col"><a href="{{ route('teams', ['order_by' => 'name', 'order_direction' => ($order_by == 'name' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Name</a></th>
                        <th scope="col"><a href="{{ route('teams', ['order_by' => 'founded', 'order_direction' => ($order_by == 'founded' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Founded</a></th>
                        <th scope="col"><a href="{{ route('teams', ['order_by' => 'stadium', 'order_direction' => ($order_by == 'stadium' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Stadium</a></th>

                        <th scope="col"></th>
                      


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamModal{{ $team->id }}">
                                    {{ $team->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="teamModal{{ $team->id }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $team->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="teamModalLabel{{ $team->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $team->id }}</p>
                                                <p>Name: {{ $team->name }}</p>
                                                <p>Founded: {{ $team->founded }}</p>
                                                <p>Stadium: {{ $team->stadium }}</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $team->name }} </td>
                            <td>{{ $team->founded }} </td>
                            <td>{{ $team->stadium }} </td>
                            <td> <a href="{{ route('teamsEdit', $team->id) }}" class="btn btn-primary mb-2">Edit</a>
                       
                                <form method="post" action="{{ route('teamsDestroy', $team->id) }}" onsubmit="return confirm('Are you sure you want to delete this team?')">
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
                        <li class="page-item {{ $teams->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $teams->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $teams->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $teams->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $teams->firstItem() }} to {{ $teams->lastItem() }} of {{ $teams->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
