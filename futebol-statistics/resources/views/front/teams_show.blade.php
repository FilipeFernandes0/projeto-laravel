@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Teams</h1>
                <p>This is the home page of all the teams of the respective competition.</p>
            </div>
        </div>
    </div>
</div>


<div class="site-section bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 title-section">
                <h2 class="heading">Teams</h2>
            </div>
            @foreach($teams as $team)
            <div class="col-lg-6 mb-4">
                <div class="bg-light p-4 rounded" style="height: 100%;">
                    <div class="widget-body d-flex align-items-center justify-content-between">
                        <div class="widget-vs">
                            <img src="{{$team->crest}}" style="max-height: 100px;">
                        </div>
                        <a href="{{ route('team_show', ['competitionId' => $team->competition_id, 'teamId' => $team->teams_id]) }}" class="text-white">
                            {{ $team->name }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

           
    </div>
</div>

@endsection
