@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}')">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 mx-auto text-center">
        <h1 class="text-white">Favorites Lists</h1>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-12 title-section">
        <h2 class="heading">Favorite List</h2>
      </div>
      
      @foreach($favorites as $favorite)
          <div class="col-lg-6 mb-4">
            <div class="bg-light p-4 rounded" style="height: 100%;"> 
              <div class="widget-body d-flex align-items-center justify-content-between"> 
                <div>
                <a href="{{ route('showTeamFavorites',  $favorite->id) }}" class="text-white"> {{ $favorite->name }}</a>
                </div>
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
</div>
  
@endsection
