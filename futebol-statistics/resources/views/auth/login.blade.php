@extends('layouts.back-layout')

@section('content')
<div class="container-fluid position-relative d-flex p-0">


    @if(\Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="alert-body">
                {{ \Session::get('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{ \Session::forget('success') }}

    @if(\Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-body">
                {{ \Session::get('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                        </a>
                        <h3>log In</h3>
                    </div>
                    <form method="POST" action="/login">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                            <label for="floatingInput">Email address</label>
                            @error('email')
                                <span class="help-block font-red-mint">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <span class="help-block font-red-mint">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Log In</button>
                        <p class="text-center mb-0">
                            Don't have an Account?
                            <a href="{{ route('register') }}">Sign Up</a>
                        </p>

                 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
