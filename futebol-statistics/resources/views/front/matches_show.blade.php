@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{ asset('assets/futebol-style/images/bg_3.jpg') }}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Matches</h1>
                <p>Upcoming matches</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex team-vs">
                <div class="col-lg-12">
                    <h3 class="text-white mb-2 mt-4 text-center">Standings</h3>

                    @if ($standings[0]->stage == 'GROUP_STAGE')

                    @foreach ($groupedStandings as $group => $groupStandings)
                    <h3 class="text-white mb-4 text-center">{{ $group }}</h3>

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
                            @foreach($groupStandings as $standing)
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

                    @endforeach
                    @else

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
                            @foreach($standings as $standing)
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


                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-12 title-section ">
                    <h2 class="heading mb-5">Upcoming Matches</h2>
                    <form action="{{ route('matches_show', ['competitionId' => $competitionId]) }}" method="GET"
                        class="search-form">
                        <div class="form-group d-flex ">
                            <input type="text" class="form-control mt-2" type="search" name="query"
                                placeholder="Type a keyword and hit enter">
                            <button type="submit" class="btn btn-primary mt-2"><span
                                    class="icon-search"></span> Search</button>
                        </div>
                    </form>
                    <form action="{{ route('matches_show', ['competitionId' => $competitionId]) }}" method="GET"
                        class="search-form">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control mt-2" type="search" name="matchday"
                                placeholder="Filter by Matchday">
                            <button type="submit" class="btn btn-primary mt-2"><span
                                    class="icon-filter_list"></span> Filter</button>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($matches as $match)
                        <div class="col-lg-6 mb-4">
                            <div class="widget-title">
                                <h3>Upcoming Match</h3>
                              </div>
                            <div class="widget-next-match p-4">
                                
                                <div class="widget-body mb-3">
                                    <div class="widget-vs">
                                        
                                        <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                                            <div class="team-1 text-center">
                                                <img src="{{ $match->homeTeam->crest }}" alt="Image"
                                                class="img-fluid" style="max-width: 30%; height: auto; margin: 0 auto;">
                                                <p class="mt-2">{{$match->homeTeam->name}}</p>
                                            </div>
                                            <div>
                                                <span class="vs"><span>VS</span></span>
                                            </div>
                                            <div class="team-2 text-center">
                                                <img src="{{ $match->awayTeam->crest }}" alt="Image"
                                                class="img-fluid" style="max-width: 30%; height: auto; margin: 0 auto;">
                                                <p class="mt-2">{{$match->awayTeam->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center widget-vs-contents">
                                    <h4 class="mb-3">Matchday: {{$match->matchday}}</h4>
                                    <p class="mb-0">
                                        <span class="d-block">Date: {{ $match->utc_date }}</span>
                                        <span class="d-block">Score: {{ $match->score }}</span>


                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-7 text-center">
                            <div class="custom-pagination">
                                @if ($matches->onFirstPage())
                                <a class="mb-2 disabled"><span class="icon-hand-o-left"
                                        style="font-size: 20px;"></span></a>
                                @else
                                <a href="{{ $matches->previousPageUrl() }}" class="mb-2"><span
                                        class="icon-hand-o-left" style="font-size: 20px;"></span></a>
                                @endif

                                @php
                                // Calculate the start and end of the pagination links
                                $start = max($matches->currentPage() - 2, 1);
                                $end = min($start + 4, $matches->lastPage());
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <a href="{{ $matches->url($i) }}"
                                    class="mb-2 {{ $matches->currentPage() == $i ? 'btn-primary' : 'btn-secondary' }}">{{ $i }}</a>
                                @endfor

                                @if ($matches->hasMorePages())
                                <a href="{{ $matches->nextPageUrl() }}" class="mb-2"><span
                                        class="icon-hand-o-right" style="font-size: 20px;"></span></a>
                                @else
                                <a class="mb-2 disabled"><span class="icon-hand-o-right"
                                        style="font-size: 20px;"></span></a>
                                @endif
                            </div>
                        </div>
                    </div>
    </div>
</div>

      


    @endsection
