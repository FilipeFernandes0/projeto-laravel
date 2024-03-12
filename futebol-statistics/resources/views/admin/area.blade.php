@extends('layouts.back-layout')

@section('content')



<div class="col-12">
  
  
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-2">Areas Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('areaCreate') }}" class="btn btn-primary">Create new Area</a>
        </div>     
        <form action="{{ route('area') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0 mb-2" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><a href="{{ route('area', ['order_by' => 'id', 'order_direction' => ($order_by == 'id' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Id</a></th>
                        <th scope="col"><a href="{{ route('area', ['order_by' => 'name', 'order_direction' => ($order_by == 'name' && $order_direction == 'asc') ? 'desc' : 'asc']) }}">Name</a></th>
                        <th scope="col"></th>
                       


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#areaModal{{ $area->id }}">
                                    {{ $area->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="areaModal{{ $area->id }}" tabindex="-1" aria-labelledby="areaModalLabel{{ $area->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="areaModalLabel{{ $area->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $area->id }}</p>
                                                <p>Name: {{ $area->name }}</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $area->name }} </td>
                            <td> 
                                <a href="{{ route('areaEdit', $area->id) }}" class="btn btn-primary mb-2">Edit</a>
                         
                                <form method="post" action="{{ route('areaDestroy', $area->id) }}" onsubmit="return confirm('Are you sure you want to delete this area?')">
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
                        <li class="page-item {{ $areas->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $areas->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $areas->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $areas->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $areas->firstItem() }} to {{ $areas->lastItem() }} of {{ $areas->total() }} results</p>

            </div>
        </div>
    </div>
</div>


@endsection
