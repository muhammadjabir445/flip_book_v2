<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="buku-online.id merupakan perusahaan penerbit buku cetak dan buku online digital.   ">
    <meta name="keywords" content="Penerbit buku sekolah, buku online digital sekolah, buku sekolah">
    <meta name="author" content="PT LINGKAR SOLUSI MANDIRI">
	<meta name="google-site-verification" content="Un3gfrcGjSq6LbTGjWdrJkkjgNuxUC8IUdz8baw6ZxE" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buku Online Digital </title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        section,.container{
            font-family: 'Oswald', sans-serif;

        }
        /* list buku */
        .list-buku{
            position: relative;
        }
        .span-list-buku {
            position: absolute;
            top: 0px;
            left: 0px;
        }
        .text-forest {
            color: 	#228B22;
        }
       /*  .section-title {
              color: 	#228B22;
        } */
        .bungkus {
            min-height: 90vh;

            display: flex;
            font-family: 'Oswald', sans-serif;
            padding: 15px;
            color: rgb(34, 34, 34);
            background-color: white;
        }

        .banner {

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
        .navbar .container{
            display: flex
        }

        .navbar .container a,.navbar .container button,.navbar .container .navbar-collapse{
            margin: auto
        }
        .lihat{
            text-align: center !important;
            padding: 30px 0px 30px 0px;
        }
        /*--------------------------------------------------------------
        # list-buku
        --------------------------------------------------------------*/
        .list-buku .ekaprima {
        margin-bottom: 20px;
        overflow: hidden;
        text-align: center;
        border-radius: 4px;
        background: #fff;
        box-shadow: 0px 2px 15px rgba(18, 66, 101, 0.08);
        }

        .list-buku .ekaprima .ekaprima-img {
        position: relative;
        overflow: hidden;

        }



        .list-buku .ekaprima .ekaprima-info {
        padding: 25px 15px;
        }

        .list-buku .ekaprima .ekaprima-info h4 {
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1em;
        color:  #191919;
        }

        .list-buku .ekaprima .ekaprima-info span {
        display: block;
        font-size: .90em;
        font-weight: 400;
        color: 	#228B22;
        }

        .list-buku .ekaprima .ekaprima-info p {
        font-style: italic;
        font-size: 14px;
        line-height: 26px;
        color: #777777;
        }

        .list-buku .ekaprima:hover .social {
        opacity: 1;
        }
        .img-thumbnail {

        height:65vh;
        }
	@media only screen and (max-width: 768px) {
        .img-thumbnail {

        height:auto;
        }
    }

    </style>
@laravelPWA
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('buku-onlinelogo.png')}}" width="180px" class="img img-responsive">
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
                                <a class="nav-link"  href="{{ route('buku-list') }}">List Buku</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('artikels') }}">Artikel</a>
                            </li>
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
                        <div class="col-12">
                        <h3 class="text-center">Di dukung oleh : </h3>
                        </div>
                    </div>
                    <div class="row p-4" >
                        <div class="col-12 text-center " >
                            <img src="{{asset('logoeka.png')}}"  class="img img-responsive w-25">
                            <img src="{{asset('bmmlogo.png')}}"  class="img img-responsive w-25">

                           <!--  <br>
                            <br>
                            <p>Alamat: <br> Jl. Kailudin No.69, Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat 16414</p>
                            <p>Telepon: 0852-1647-5603</p>
                            &copy; 2020 CV Eka Prima Mandiri -->
                        </div>
                          <!--  <div class="col-12 col-md-6 text-center" >
                         <img src="{{asset('bmmlogo.png')}}" width="50%" class="img img-responsive">
                          <br>
                            <br>
                            <p>Alamat: <br> Jl. Kailudin No.69, Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat 16414</p>
                            <p>Telepon: 0852-1647-5603</p>
                            &copy; 2020 CV Eka Prima Mandiri
                        </div>-->

                        <!-- <div class="col-12 col-md-6">
                            <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=cv%20eka%20prima%20mandiri&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://buku-online.id">CV Eka Prima Mandiri</a></div><style>.mapouter{position:relative;text-align:right;}.gmap_canvas {overflow:hidden;background:none!important;}</style></div>
                        </div> -->
                    </div>
                </div>
        </section>
        <div class="card-footer text-muted text-center">
            buku-online.id @2020
        </div>
    </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
