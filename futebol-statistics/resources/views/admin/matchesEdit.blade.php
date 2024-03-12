@extends('layouts.back-layout')

@section('content')


<div class="container-fluid pt-6 px-6">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">Edit Match </h6>
                <form method="post" action="{{ route('matchesUpdate', $matches->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label"> Home Team ID</label>
                        <input type="text" name="home_team_id" class="form-control" id="seasonName" value="{{ $matches->home_team_id }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Away Team ID</label>
                        <input type="text" name="away_team_id" class="form-control" id="seasonName" value="{{ $matches->away_team_id }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">  Matchday</label>
                        <input type="text" name="matchday" class="form-control" id="seasonName" value="{{ $matches->matchday }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> score</label>
                        <input type="text" name="score" class="form-control" id="seasonName" value="{{ $matches->score }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Winner</label>
                        <input type="text" name="winner" class="form-control" id="seasonName" value="{{ $matches->winner }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Competition Id</label>
                        <input type="text" name="competition_id" class="form-control" id="seasonName" value="{{ $matches->competition_id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>



@endsection
