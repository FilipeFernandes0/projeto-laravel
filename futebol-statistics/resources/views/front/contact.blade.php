@extends('layouts.front-layout')

@section('content')

<div class="hero overlay" style="background-image: url('{{asset('assets/futebol-style/images/bg_3.jpg')}}">
    <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-9 mx-auto text-center">
            <h1 class="text-white">Contact</h1>
          </div>
        </div>
      </div>
    </div>

    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <form method="POST" action="{{ route('contactPost') }}" class="d-inline">
               @csrf
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" >
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject" name="subject">
              </div>
              <div class="form-group">
                <textarea name="message" class="form-control" id="" cols="30" rows="10" placeholder="Write something..."></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary py-3 px-5">
              </div>
            </form>  
          </div>
          <div class="col-lg-4 ml-auto">
            
          </div>
        </div>
      </div>
    </div>



    @endsection