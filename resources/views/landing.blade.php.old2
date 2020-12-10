@extends('layouts.app')



@section('content')

<!-- banner -->
<section class="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('banner-epm2.png')}}" alt="First slide">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('banner-epm1.png')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('banner-epm3.png')}}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section> 
<!-- end banner -->

<section class="bungkus">
    <div class="container landing">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="text-primary">Buku Online Digital </h1>
                <h4 class="text-warning">Buku adalah sumber belajar. Bawa buku perkaya ilmu</h4>
            
                <h5 class="mt-4">Buku-online.id Buku Digital dalam genggaman. Merupakan media proses belajar yang modern, 
                simple dan fleksible bagi siswa dan guru.</h5>
                <br>
                <button type="button" onclick="window.location.href='/login'" style="border-radius:50px" class="btn btn-primary">Baca Sekarang</button>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{asset('Buku-online1.PNG')}}" alt="" height="100%" width="100%">
            </div>
        </div>
    </div>
</section>
<section class="list-buku">
    <div class="container text-center">
        <label for="" style="font-size: 25px">Daftar Buku</label>
        <hr>
        <div class="buku">
            @foreach ($data as $item)
            @php
                  $direktori = explode('/',$item->folder);
                    $direktori = array_key_exists(1,$direktori) ? $direktori[1] : '';
            @endphp
            <div class="card mt-1 mr-2 ml-2 mb-1" style="max-width: 18rem; -webkit-box-shadow: -2px 2px 7px 2px rgba(0,0,0,0.11);
            box-shadow: -2px 2px 7px 2px rgba(0,0,0,0.11); border-radius:0px;border:none">
                <img src="{{asset('storage/' . $item->folder . "/{$direktori}" . "-0.jpg")}}"  width="100%"  class="card-img-top " alt="{{$item->judul_buku}}">
                <div class="card-body">
                  <div class="card-title text-center w-auto ">
                    <hr>
                    <small color="#0097A7" class="text-center" style="font-weight: bold; margin: 0px auto;">{{$item->judul_buku}}</small>
                    <hr>
                    <small color="#0097A7" class="text-center" style="font-weight: bold; margin: 0px auto;">Rp. {{number_format($item->harga)}}</small>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <br>
        <button type="button" onclick="window.location.href='/login'" style="border-radius:40px;padding:5px;40px;5px;40px; width:50%" class="btn btn-success">Lihat lebih banyak buku</button>
    </div>

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $('.buku').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true,
  arrows:true
});
</script>
@endsection
