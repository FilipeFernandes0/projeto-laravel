@extends('layouts.back-layout')

@section('content')


<div class="container-fluid pt-6 px-6">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">Edit Teams </h6>
                <form method="post" action="{{ route('teamsUpdate', $teams->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label">Name for the new Team</label>
                        <input type="text" name="name" class="form-control" id="teamsName" value="{{ $teams->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">what year was founded</label>
                        <input type="text" name="founded" class="form-control" id="teamsName" value="{{ $teams->founded }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">what stadium does it play?</label>
                        <input type="text" name="stadium" class="form-control" id="teamsName" value="{{ $teams->stadium }}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>



@endsection
