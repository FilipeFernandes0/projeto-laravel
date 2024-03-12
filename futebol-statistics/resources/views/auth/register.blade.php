@extends('layouts.back-layout')

@section('content')
   
    
        <div class="container-fluid position-relative d-flex p-0">
        
    
    
            <!-- Sign Up Start -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                                </a>
                                <h3>Register</h3>
                            </div>
                            <form method="POST" action="/register">

                                @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingName" placeholder="name" name="name" value="{{old('name')}}">
                                <label for="floatingName">Name</label>
                                @error('name')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingUsername" placeholder="username" name="username" value="{{old('username')}}">
                                <label for="floatingUsername">Username</label>
                                @error('username')
                                    <p >{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{old('email')}}">
                                <label for="floatingInput">Email address</label>
                                @error('email')
                                    <p >{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <p>{{$message}}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="/login">Sign In</a></p>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
            <!-- Sign Up End -->
        </div>
    
      
@endsection

