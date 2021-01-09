@extends('layouts.app')



@section('content')

<!-- banner -->
<section class="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($gambar as $index => $item)
        <div class="carousel-item {{$index === 0 ? ' active' : ''}}">
        <img class="d-block w-100" src="{{asset('storage/' . $item->foto)}}" alt="First slide">
        </div>
        @endforeach

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
                <h4 class="text-muted">Buku adalah sumber belajar. Bawa buku perkaya ilmu</h4>

                <h5 class="mt-4 text-forest">Buku-online.id Buku Digital dalam genggaman. Merupakan media proses belajar yang modern,
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


 <!-- ======= list-buku Section ======= -->
 <section id="list-buku" class="list-buku section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center text-forest ">
          <h2><span>Buku Online Digital</span>  </h2>
          <p>Dapatkan buku pelajaran TK/PAUD, SD, SMP, SMA dari penerbit EKA PRIMA MANDIRI dan BUKIT MAS MULIA. Dengan <a href="buku-online.id">buku-online.id</a>
            belajar jadi lebih mudah dan fleksible, kapan saja dan dimana saja. </p>
        </div>

        <div class="row pt-4">
         @foreach ($data as $item)
            @php
                  $direktori = explode('/',$item->folder);
                    $direktori = array_key_exists(1,$direktori) ? $direktori[1] : '';
            @endphp
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="ekaprima">
              <div class="ekaprima-img">
                <img src="data:image/png;base64,{{base64_encode(file_get_contents(public_path('storage/' . $item->folder . "/{$direktori}" . "-0.jpg")))}}" class="img-thumbnail" alt="{{$item->judul_buku}}">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="ekaprima-info">
                <h4>{{$item->judul_buku}}</h4>
                <span>Rp. {{number_format($item->harga)}}</span>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>

	<div class="lihat">
    		<button type="button" onclick="window.location.href='/login'" style="border-radius:40px;padding:5px;40px;5px;40px; width:50%" class="btn btn-success">Lihat lebih banyak buku</button>
    	</div>
    </section><!-- End list-buku Section -->

<!-- <section class="list-buku">
    <div class="container text-center">
        <label for="" style="font-size: 25px">Daftar Buku</label>
        <hr>
        <div class="buku">
            @foreach ($data as $item)
            @php
                  $direktori = explode('/',$item->folder);
                    $direktori = array_key_exists(1,$direktori) ? $direktori[1] : '';
            @endphp
            <div class="card mt-1 mr-2 ml-2 mb-1" style="width: 12rem; -webkit-box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.75); border-radius:0px;border:none">
                <img src="{{asset('storage/' . $item->folder . "/{$direktori}" . "-0.jpg")}}"  width="100vw" height="270vh" class="card-img-top " alt="{{$item->judul_buku}}">
                <div class="card-body">
                  <div class="card-title text-center w-auto " style="font-size:.75em;">{{$item->judul_buku}}</div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <br>
        <button type="button" onclick="window.location.href='/login'" style="border-radius:40px;padding:5px;40px;5px;40px; width:50%" class="btn btn-success">Lihat lebih banyak buku</button>
    </div>

</section> -->


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
