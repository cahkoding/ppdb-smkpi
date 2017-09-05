<!DOCTYPE html>
<html>
  <head>
    <title>Halaman Public</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.8.36/css/materialdesignicons.min.css">
    <link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

  </head>
  <body>

      <!-- <div class="navbar-fixed"> -->

      <ul id="menuDropdown" class="dropdown-content">
        <li> <a href="#">F.A.Q</a></li>
        <li> <a href="#">Hubungi</a></li>
      </ul>
      <ul id="menuDropdown2" class="dropdown-content">
        <li> <a href="#">F.A.Q</a></li>
        <li> <a href="#">Hubungi</a></li>
      </ul>

          <nav class="indigo darken-3">

              <div class="nav-wrapper container">
                {{-- <a href="#" class="brand-logo">PPDB ONLINE</a> --}}
                <a href="#" data-activates="mobile-menu" class="button-collapse">
                  <i class="material-icons">menu</i>
                </a>

                <ul class="hide-on-med-and-down">
                  <li><a href="#">Home</a></li>
                  <li class="active"><a href="#">Peserta</a></li>
                  <li><a href="#">Kontak</a></li>
                  <li><a href="#" class="dropdown-button" data-activates="menuDropdown">Help <i class="material-icons right">keyboard_arrow_down</i></a></li>
                  @if (Auth::guest())
                    <li class="right"><a href="/login">Login</a></li>
                    <li class="right"><a href="/register">Daftar</a></li>
                  @else
                    <li class="right">
                        <a href="#" class="dropdown-button" data-activates="userDropdown">
                            {{ Auth::user()->name }} <span class="caret"></span><i class="material-icons right">keyboard_arrow_down</i>
                        </a>

                        <ul id="userDropdown" class="dropdown-content">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                  @endif

                </ul>

                <ul class="side-nav" id="mobile-menu">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Peserta</a></li>
                  <li><a href="#">Kontak</a></li>
                  <li><a href="#" class="dropdown-button" data-activates="menuDropdown2">Help <i class="material-icons right">keyboard_arrow_down</i></a></li>
                  @if (Auth::guest())
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Daftar</a></li>
                  @endif

                </ul>
              </div>
          </nav>
      <!-- </div> -->
      <br><br>
      <div class="container">
          @yield('konten')
      </div>

      <footer class="page-footer indigo darken-3 white-text">
        <div class="container">
          <div class="row">
             <div class="col s12 m12 l4">
               Copyright &copy; 2017
               <br>KHIHADY SUCAHYO PPDB ONLINE
               <br>All Right Reserved
             </div>
             <div class="col s12 m12 l2">
               <strong>Menu</strong>
               <ul class="putih-text">
                 <li ><a href="#">PHP</a></li>
                 <li><a href="#">JAVA</a></li>
                 <li><a href="#">MySQL</a></li>
               </ul>
             </div>
             <div class="col s12 m12 l2"><strong>Links</strong></div>
             <div class="col s12 m12 l4">
              <strong>SMK PI AMBARRUKMO 1 SLEMAN</strong>
              <br>
              Jl. Cendrawasih 125 Mancasan lor, Condong Catur, Depok,Sleman 55283
             </div>
          </div>
        </div>

        <div class="footer-copyright indigo darken-4">
          <div class="container">
            <div class="row">

              <div class="col s12 m11 11">
                <a href="#">
                  <i class="material-icons">school</i>
                  <strong>SMK PI AMBARRUKMO 1 SLEMAN</strong>
                </a>
              </div>

              <div class="right col s12 m1 l1">
                  <a href="#"><i class="mdi mdi-facebook-box"></i></a>
                  <a href="#"><i class="mdi mdi-twitter-box"></i></a>
                  <a href="#"><i class="mdi mdi-youtube-box"></i></a>
              </div>

            </div>
          </div>
        </div>
      </footer>



      <!-- <script src="materialize/js/jquery-3.1.1.min.js"></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="/materialize/js/materialize.min.js"></script>
      <script>
        $(document).ready(function(){
          $('.slider').slider();

          $('.button-collapse').sideNav();
        });
      </script>
  </body>

</html>
