@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6 px-6">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New Person</h6>
                    <form method="post" action="{{ route('personsStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name for the new Person</label>
                            <input type="text" name="name" class="form-control" id="competitonName">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" id="competitonName">
                        </div>
                        
                        
                        <div class="mb-3">
                            <label class="form-label">Team Id associated with the person</label>
                            <input type="text" name="team_id" class="form-control" id="AreaName">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
