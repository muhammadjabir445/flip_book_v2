<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CV Eka Prima Mandiri </title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
{{-- <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        section{
            font-family: 'Oswald', sans-serif;

        }
        .bungkus {
            min-height: 90vh;

            display: flex;
            font-family: 'Oswald', sans-serif;
            padding-top: 20px;
            color: rgb(34, 34, 34);
            background-color: white;
        }
        .landing h3{
            font-size: 20px;
            line-height: 1.57;
        }
        .landing h1 {
            font-weight: bold;
        }
        .landing{
            margin: auto;
        }

        .landing .col-12 {
            margin: auto
        }

        .nav-item .nav-link{

            border-radius:20px !important;
            padding: 5px 30px 5px 30px !important;
        }

        .list-buku{
            padding: 20px 0px 20px 0px;
        }

        .footer{
            background-color: white;
            padding: 30px 0px 30px 0px
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('logoeka.png')}}" width="180px" class="img img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" style="background-color: #e91e63 !important;color:white;" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>


         @yield('content')
        <section class="footer">

                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img src="{{asset('logoeka.png')}}" width="50%" class="img img-responsive">
                            <br>
                            <br>
                            <p>Alamat: <br> Jl. Kailudin No.69, Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat 16414</p>
                            <p>Telepon: 0852-1647-5603</p>
                            &copy; 2020 CV Eka Prima Mandiri
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=cv%20eka%20prima%20mandiri&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://buku-online.id">CV Eka Prima Mandiri</a></div><style>.mapouter{position:relative;text-align:right;}.gmap_canvas {overflow:hidden;background:none!important;}</style></div>
                        </div>
                    </div>
                </div>
        </section>

    </div>
</body>
</html>
