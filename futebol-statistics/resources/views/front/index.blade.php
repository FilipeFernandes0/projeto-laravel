@extends('layouts.front-layout')

@section('content')
    <div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 ml-auto">
            <h1 class="text-white">Home</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="latest-news">
      <div class="container">
        <div class="row no-gutters">
          @foreach($randomCompetition as $competition)
          <div class="col-md-4">
            <a href="{{ route('matches_show', ['competitionId' => $competition->competitions_id]) }}" class="post-entry">
              <img src="{{$competition->emblem}}" alt="Image" class="img-fluid" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
         
    <div class="site-section bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <a href="{{ route('matches_show', ['competitionId' => $randomMatch->competition_id]) }}" class="widget-next-match">
    
              <div class="widget-next-match">
                <div class="widget-title">
                  <h3>Next Match</h3>
                </div>
                <div class="widget-body mb-3">
                  <div class="widget-vs">
                    <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                      <div class="team-1 text-center">
                        <img src="{{ $randomMatch->homeTeam->crest }}" alt="Image">
                        <h3>{{$randomMatch->homeTeam->name}}</h3>
                      </div>
                      <div>
                        <span class="vs"><span>VS</span></span>
                      </div>
                      <div class="team-2 text-center">
                        <img src="{{ $randomMatch->awayTeam->crest }}" alt="Image">
                        <h3>{{$randomMatch->awayTeam->name}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="text-center widget-vs-contents mb-4">
                  <h4>matchday: {{$randomMatch->matchday}}</h4>
                  <p class="mb-5">
                    <span class="d-block"> Date: {{ $randomMatch->utc_date }}</span>
                    <strong class="text-primary">{{ $randomMatch->homeTeam->venue }}</strong>
                  </p>
                </div>
              </div>
            </a> <!-- Move the closing </a> tag here -->
          </div>
          <div class="col-lg-6">
            <div class="widget-next-match">                        
              <table class="table custom-table table-responsive-lg"> 
                <thead>
                  <tr>
                    <th>Position</th>
                    <th>Team</th>
                    <th>Played Games</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>PTS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($randomStandings as $standing)
                  <tr>
                    <td>{{ $standing->position }}</td>
                    <td>
                      @if ($standing->team && $standing->team->name)
                      <a href="{{ route('team_show', ['competitionId' => $competitionId, 'teamId' => $standing->team->teams_id]) }}" class="text-white">{{ $standing->team->name }}</a>
                      @else
                      <em>Team name not found</em>
                      @endif
                    </td>                                            
                    <td>{{ $standing->playedGames }}</td>
                    <td>{{ $standing->won }}</td>
                    <td>{{ $standing->draw }}</td>
                    <td>{{ $standing->lost }}</td>
                    <td>{{ $standing->points }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .site-section -->
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-6 title-section">
            <h2 class="heading">Teams</h2>
          </div>
          <div class="col-6 text-right">
            <div class="custom-nav">
              <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
              <span></span>
              <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
            </div>
          </div>
        </div>
    
        <div class="owl-4-slider owl-carousel">
          @foreach($randomTeam as $team)
          <a href="{{ route('team_show', ['competitionId' => $competitionId, 'teamId' => $team->teams_id]) }}" class="item">
            <div class="item">
              <div class="team">
                <img src="{{$team->crest}}" alt="Image" class="img-fluid" style="max-width: 50%; height: auto; display: block; margin: 0 auto;">               
                
              </div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
    

    @if(session()->has('success'))
      <div>
        <p>{{ session('success') }}</p>
      </div>
    @endif

@endsection