
@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6 px-6">
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New Match</h6>
                    <form method="post" action="{{ route('matchesStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"> Home Team ID</label>
                            <input type="text" name="home_team_id" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Away Team ID</label>
                            <input type="text" name="away_team_id" class="form-control" id="seasonName">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">  Matchday</label>
                            <input type="text" name="matchday" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> score</label>
                            <input type="text" name="score" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Winner</label>
                            <input type="text" name="winner" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> competition Id</label>
                            <input type="text" name="competition_id" class="form-control" id="seasonName">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
