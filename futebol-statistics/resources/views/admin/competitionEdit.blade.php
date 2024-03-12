@extends('layouts.back-layout')

@section('content')


<div class="container-fluid pt-6 px-6">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-4">Edit Competition </h6>
                <form method="post" action="{{ route('competitionUpdate', $competition->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label">Name for the updated competition</label>
                        <input type="text" name="name" class="form-control" id="CompetitionName" value="{{ $competition->name }}"
                           >
                       
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="type" aria-label="Floating label select example">
                            <option value="updated" {{ $competition->type === 'updated' ? 'selected' : '' }}>Updated Type</option>
                            <option value="league" {{ $competition->type === 'league' ? 'selected' : '' }}>LEAGUE</option>
                            <option value="cup" {{ $competition->type === 'cup' ? 'selected' : '' }}>CUP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Area Id associated with the competition</label>
                        <input type="text" name="area_id" class="form-control" id="AreaName" value="{{ $competition->area_id }}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>



@endsection
