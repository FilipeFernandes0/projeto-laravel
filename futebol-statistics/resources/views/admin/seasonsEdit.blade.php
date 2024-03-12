@extends('layouts.back-layout')

@section('content')


<div class="container-fluid pt-6 px-6">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-4">Edit Season </h6>
                <form method="post" action="{{ route('seasonsUpdate', $seasons->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="form-label"> Start Date for the updated season</label>
                        <input type="text" name="startDate" class="form-control" id="startDate" value="{{ $seasons->startDate }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> End Date for the updated season</label>
                        <input type="text" name="endDate" class="form-control" id="endDate" value="{{ $seasons->endDate }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"> Current Matchday for the updated season</label>
                        <input type="text" name="currentMatchday" class="form-control" id="seasonName" value="{{ $seasons->currentMatchday }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> The Winner of the updated season</label>
                        <input type="text" name="winner" class="form-control" id="seasonName" value="{{ $seasons->winner }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> competition ID</label>
                        <input type="text" name="competition_id" class="form-control" id="seasonName" value="{{ $seasons->competition_id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>



@endsection
