@extends('layouts.back-layout')

@section('content')
    <div class="container-fluid pt-6">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded p-4">
                    <h6 class="mb-4">New Competition</h6>
                    <form method="post" action="{{ route('competitionStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name for the new competition</label>
                            <input type="text" name="name" class="form-control" id="competitonName">
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="type" aria-label="Floating label select example">
                                <option selected>New Type</option>
                                <option value="league">LEAGUE</option>
                                <option value="cup">CUP</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area Id associated with the competition</label>
                            <input type="text" name="area_id" class="form-control" id="AreaName">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

