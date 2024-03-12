@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{ asset('assets/futebol-style/images/bg_3.jpg') }}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="text-white">Favorite Team</h1>
                <p>Page for this Favorites List.</p>
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
        </div>
        <div class="modal fade" id="editFavoritetModal" tabindex="-1" role="dialog" aria-labelledby="editFavoriteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="editFavoriteModalLabel">Edit Favorite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @foreach ($favoriteLists as $favoriteList)

                <form id="editFavoriteForm" method="POST" action="{{ route('updateFavoritesName', $favoriteList->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="update_favorite_list_name">Update Favorite List:</label>
                        <input type="text" class="form-control" id="update_favorite_list_name" name="name" value="{{ $favoriteList->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Favorites List</button>
                </form>
                @endforeach 

            </div>
        </div>
    </div>
</div>
        @foreach($response['favorites'] as $favorite)
        <div class="d-flex align-items-center mb-3">
            <h3>{{ $favorite['name'] }}</h3>
            <button type="button" class="btn btn-link p-0 edit-comment ml-2" data-toggle="modal" data-target="#editFavoritetModal">
                <span class="icon-edit" style="font-size: 20px;"></span>
            </button>
        </div>
            
            <div class="row">
                @foreach($favorite['teams'] as $team)
                    <div class="col-lg-6 mb-4">
                        <div class="bg-light p-4 rounded" style="height: 100%;"> 
                            <div class="widget-body d-flex align-items-center justify-content-between"> 
                                <div class="widget-vs">
                                    <img src="{{ $team['crest'] }}" style="max-height: 100px;">
                                </div>
                                <div>
                                    <h5>{{ $team['name'] }}</h5>
                                    <h6>{{ $team['stadium'] }}</h6>
                                    <h6>{{ $team['founded'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        
    </div>
</div>
@endsection
