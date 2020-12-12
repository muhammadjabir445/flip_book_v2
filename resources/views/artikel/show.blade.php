@extends('layouts.app')



@section('content')
    <div class="container mt-4 mb-4">

                    <div class="p-5 bg-white mb-5" style="-webkit-box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);
                    -moz-box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);
                    box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);
                    " >

                        <h3>{{$item->judul}}</h3>
                        <small>{{$item->created_at->format('Y-m-d')}}</small>

                        <br>
                        <br>
                        <br>
                        <img src="{{asset('storage/' . $item->foto)}}" width="100%" class="img img-responsive">
                        <br>
                        <br>

                        {!! $item->isi_artikel !!}


                    </div>


    </div>
@endsection
