@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 mx-auto text-center">
        <h1 class="text-white">Teams</h1>
        <p>This is the home page of all the teams competition.</p>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-dark">
  <div class="container">

    <div class="row">
      <div class="col-12 title-section">
        <h2 class="heading">Teams</h2>
        <form action="{{ route('showAllTeams') }}" method="GET" class="search-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control mt-2" type="search" name="query" placeholder="Type a keyword and hit enter">
            <button type="submit" class="btn btn-primary mt-2"><span class="icon-search"></span> Search</button>
          </div>
        </form>
        <form action="{{ route('showAllTeams') }}" method="GET" class="search-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control mt-2" type="search" name="competition" placeholder="Filter by Competition">
            <button type="submit" class="btn btn-primary mt-2"><span class="icon-filter_list"></span> Filter</button> 
          </div>
        </form>
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
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <div class="custom-pagination">
          @if ($teams->onFirstPage())
          <a class="disabled"><span class="icon-hand-o-left" style="font-size: 20px;"></span></a>
          @else
          <a href="{{ $teams->previousPageUrl() }}"><span class="icon-hand-o-left" style="font-size: 20px;"></span></a>
          @endif

          @php
          // Calculate the start and end of the pagination links
          $start = max($teams->currentPage() - 2, 1);
          $end = min($start + 4, $teams->lastPage());
          @endphp

          @for ($i = $start; $i <= $end; $i++)
          <a href="{{ $teams->url($i) }}" class="{{ $teams->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
          @endfor

          @if ($teams->hasMorePages())
          <a href="{{ $teams->nextPageUrl() }}"><span class="icon-hand-o-right" style="font-size: 20px;"></span></a>
          @else
          <a class="disabled"><span class="icon-hand-o-right" style="font-size: 20px;"></span></a>
          @endif
        </div>
      </div>
    </div>


  </div>
</div>

@endsection
