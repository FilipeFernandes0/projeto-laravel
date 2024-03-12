<!DOCTYPE html>
<html lang="en">

<head>
  <title>Soccer &mdash; Website by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



  <link rel="stylesheet" href="{{asset('assets/futebol-style/fonts/icomoon/style.css')}}">



  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/bootstrap/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/owl.theme.default.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/jquery.fancybox.min.css')}}">

  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/bootstrap-datepicker.css')}}">

  <link rel="stylesheet" href="{{asset('assets/futebol-style/fonts/flaticon/font/flaticon.css')}}">

  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/aos.css')}}">

  <link rel="stylesheet" href="{{asset('assets/futebol-style/css/style.css')}}">



</head>

<body>

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="/">
              <img src="{{asset('assets/futebol-style/images/logo.png')}}" alt="Logo">
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="/" class="nav-link" ><span class="icon-home mr-2"></span>Home</a></li>
                <li><a href="/teams" class="nav-link">Teams</a></li>
                <li><a href="/favorites" class="nav-link">Favorites</a></li>
                <li><a href="/competitions" class="nav-link">Competitions</a></li>
                <li><a href="/contact" class="nav-link"><span class="icon-phone2 mr-2"></span>Contact</a></li>

                @auth
                  <li style="color: black"> <span> Welcome, {{auth()->user()->name}}</span></li>

                  <li>
                    <form method="POST" action="/logout" class="nav-link">
                        @csrf
                        <button type="submit" class="logout-button btn btn-primary">
                            <i class="fas fa-power-off"></i> Log Out
                        </button>
                    </form>
                </li>

                @else 
                <li><a href="/register" class="nav-link">Register</a></li>
                <li><a href="/login" class="nav-link">Log In</a></li>


                @endauth

              </ul>
            </nav>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span
                class="icon-menu h3 text-white"></span></a>
          </div>
        </div>
      </div>

    </header>

    @yield('content')

    

    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Matches</h3>
              <ul class="list-unstyled links">
                <li><a href="/competitions/2000/matches/">World Cup</a></li>
                <li><a href="/competitions/2014/matches/">La Liga</a></li>
                <li><a href="/competitions/2021/matches/">Premier League</a></li>
                <li><a href="/competitions/2017/matches/">Primeira Liga</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Teams</h3>
              <ul class="list-unstyled links">
                <li><a href="/competitions/2000/teams/">World Cup</a></li>
                <li><a href="/competitions/2014/teams/">La Liga</a></li>
                <li><a href="/competitions/2021/teams/">Premier League</a></li>
                <li><a href="/competitions/2017/teams/">Primeira Liga</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12">
            <div class="pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    



  </div>
  <!-- .site-wrap -->

  <script src="{{asset('assets/futebol-style/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery-ui.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/aos.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.sticky.js')}}"></script>
  <script src="{{asset('assets/futebol-style/js/jquery.mb.YTPlayer.min.js')}}"></script>


  <script src="{{asset('assets/futebol-style/js/main.js')}}"></script>

</body>

</html>