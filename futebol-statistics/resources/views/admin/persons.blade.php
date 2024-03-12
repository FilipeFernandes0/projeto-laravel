@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Persons Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('personsCreate') }}" class="btn btn-primary">Create new Person</a>
        </div> 
        <form action="{{ route('persons') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="{{ route('persons', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a></th>
                        <th scope="col"><a href="{{ route('persons', ['order_by' => 'name', 'order_direction' => ($order_by == 'name' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Name</a></th>
                        <th scope="col"><a href="{{ route('persons', ['order_by' => 'position', 'order_direction' => ($order_by == 'position' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Position</a></th>
                        <th scope="col"><a href="{{ route('persons', ['order_by' => 'team_id', 'order_direction' => ($order_by == 'team_id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Team Id</a></th>

                        <th scope="col"></th>
                      


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($persons as $person)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personModal{{ $person->id }}">
                                    {{ $person->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="personModal{{ $person->id }}" tabindex="-1" aria-labelledby="personModalLabel{{ $person->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="personModalLabel{{ $person->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $person->id }}</p>
                                                <p>Name: {{ $person->name }}</p>
                                                <p>Position: {{ $person->position }}</p>
                                                <p>Team ID: {{ $person->team->name }}</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td>{{ $person->name }} </td>
                            <td>{{ $person->position }} </td>
                            <td>{{ $person->team->name }} </td>
                            <td> <a href="{{ route('personsEdit', $person->id) }}" class="btn btn-primary mb-2">Edit</a>
                          
                                <form method="post" action="{{ route('personsDestroy', $person->id) }}" onsubmit="return confirm('Are you sure you want to delete this person?')">
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
                        <li class="page-item {{ $persons->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $persons->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $persons->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $persons->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $persons->firstItem() }} to {{ $persons->lastItem() }} of {{ $persons->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
