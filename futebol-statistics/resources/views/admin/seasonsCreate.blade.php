
@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6 px-6">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New Season</h6>
                    <form method="post" action="{{ route('seasonsStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"> Start Date for the new season</label>
                            <input type="date" name="startDate" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> End Date for the new season</label>
                            <input type="date" name="endDate" class="form-control" id="seasonName">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"> Current Matchday for the new season</label>
                            <input type="text" name="currentMatchday" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> The Winner of the new season</label>
                            <input type="text" name="winner" class="form-control" id="seasonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> ID da competicao</label>
                            <input type="text" name="competition_id" class="form-control" id="seasonName">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
