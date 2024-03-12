@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Competitions</h1>
                <p>This is the home page of all the competitions.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 title-section">
                <h2 class="heading">Competitions</h2>
                <form action="{{ route('index') }}" method="GET" class="search-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control mt-2" type="search" name="query" placeholder="Enter Keyword">
                      <button type="submit" class="btn btn-primary mt-2"><span class="icon-search"></span> Search</button>
                    </div>
                  </form>
                  <form action="{{ route('index') }}" method="GET" class="search-form">
                    <div class="form-group d-flex">
                        <select name="type" class="form-control mt-2 bg-dark">
                            <option value="">All</option>
                            <option value="cup" {{ request('type') == 'cup' ? 'selected' : '' }}>Cup</option>
                            <option value="league" {{ request('type') == 'league' ? 'selected' : '' }}>League</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2"><span class="icon-filter_list"></span> Filter</button>
                    </div>
                  </form>
                  <form action="{{ route('index') }}" method="GET" class="search-form">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control mt-2" type="search" name="country" placeholder="Filter by Country">

                        <button type="submit" class="btn btn-primary mt-2"><span class="icon-filter_list"></span> Filter</button>
                    </div>
                  </form>
                  
            </div>
            
            @foreach($competitions as $competition)
                <div class="col-lg-6 mb-4">
                    <div class="bg-light p-4 rounded" style="height: 100%;"> 
                        <div class="widget-body d-flex align-items-center justify-content-between"> 
                            <div class="widget-vs">
                                <a href="{{ route('matches_show', $competition->competitions_id) }}">
                                    <img src="{{$competition->emblem}}" style="max-height: 100px;">
                                </a>
                            </div>
                            
                            <a href="{{ route('matches_show', $competition->competitions_id) }}">
                                <h3 style="font-size: 18px; text-align:center;">{{ $competition->name }}</h3>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
   

            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="custom-pagination text-center">
                        @if ($competitions->onFirstPage())
                            <a class="mb-2 disabled"><span class="icon-hand-o-left" style="font-size: 20px;"></span></a>
                        @else
                            <a href="{{ $competitions->previousPageUrl() }}" class="mb-2"><span class="icon-hand-o-left" style="font-size: 20px;"></span></a>
                        @endif
                        
                        @for ($i = 1; $i <= $competitions->lastPage(); $i++)
                            <a href="{{ $competitions->url($i) }}" class="mb-2 {{ $competitions->currentPage() == $i ? 'btn-primary' : 'btn-secondary' }}">{{ $i }}</a>
                        @endfor
                        
                        @if ($competitions->hasMorePages())
                            <a href="{{ $competitions->nextPageUrl() }}" class="mb-2"><span class="icon-hand-o-right" style="font-size: 20px;"></span></a>
                        @else
                            <a class=" disabled"><span class="icon-hand-o-right" style="font-size: 20px;"></span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection
