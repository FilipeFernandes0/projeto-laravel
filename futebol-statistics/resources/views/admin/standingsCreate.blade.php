
@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6 px-6">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New Standing</h6>
                    <form method="post" action="{{ route('standingsStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Position of the Team in the standing</label>
                            <input type="text" name="position" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> How many games did the team play?</label>
                            <input type="text" name="playedGames" class="form-control" id="standingName">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">How many did it won?</label>
                            <input type="text" name="won" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> How many did it draw?</label>
                            <input type="text" name="draw" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> How many did it lost?</label>
                            <input type="text" name="lost" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> How many points?</label>
                            <input type="text" name="points" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> What is the team ID?</label>
                            <input type="text" name="team_id" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> What is the competition ID?</label>
                            <input type="text" name="competition_id" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> What is the Stage?</label>
                            <input type="text" name="stage" class="form-control" id="standingName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> What is the Group?</label>
                            <input type="text" name="group" class="form-control" id="standingName">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
