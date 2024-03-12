@extends('layouts.back-layout')

@section('content')



<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Users Table</h6>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('usersCreate') }}" class="btn btn-primary">Create new User</a>
        </div> 
        <form action="{{ route('users') }}" method="GET" class="d-none d-md-flex">
            <input class="form-control bg-dark border-0" type="search" name="query" placeholder="Search">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is Admin</th>
                        <th scope="col">Password</th>


                        <th scope="col"></th>
                        


                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                                    {{ $user->id }}
                                </button>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="userModalLabel{{ $user->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $user->id }}</p>
                                                <p>Name: {{ $user->name }}</p>
                                                <p>Username: {{ $user->username }}</p>
                                                <p> Email: {{ $user->email }}</p>
                                                <p>Is Admin: {{ $user->is_admin }}</p>
                                            

                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->name }} </td>
                            <td> {{ $user->username }}</td>
                            <td>{{ $user->email }} </td>
                            <td> {{ $user->is_admin }}</td>
                            <td>{{ $user->password }} </td>

                            <td>
                                <a href="{{ route('usersEdit', $user->id) }}" class="btn btn-primary mb-2">Edit</a>
                                <form method="post" action="{{ route('usersDestroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                        <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="mb-0">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results</p>

            </div>
        </div>
    </div>
</div>

@endsection
