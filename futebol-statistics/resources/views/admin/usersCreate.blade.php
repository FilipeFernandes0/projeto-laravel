
@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6 px-6">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New User</h6>
                    <form method="post" action="{{ route('usersStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"> Name</label>
                            <input type="text" name="name" class="form-control" id="usersName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Username</label>
                            <input type="text" name="username" class="form-control" id="usersName">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"> Email</label>
                            <input type="email" name="email" class="form-control" id="usersName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Password</label>
                            <input type="password" name="password" class="form-control" id="usersName">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_admin" class="form-check-input" id="isAdmin" value="1">
                            <label class="form-check-label" for="isAdmin">Admin</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
