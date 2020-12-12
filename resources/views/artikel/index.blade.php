@extends('layouts.app')



@section('content')
    <div class="container mt-4 mb-4">

            @foreach ($data as $item)

                    <div class="p-2 bg-white mb-5" style="-webkit-box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);
                    -moz-box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);
                    box-shadow: 10px 10px 11px -10px rgba(0,0,0,0.75);max-height:270px
                    " >
                        <div class="row">
                            <div class="col-4" style="max-height:250px">
                                <a href="{{route('artikels.read',[$item->slug])}}">
                                    <img src="{{asset('storage/' . $item->foto)}}" height="100%" width="100%" class="img img-responsive">
                                </a>


                            </div>
                            <div class="col-8" style="overflow: hidden;max-height:240px">
                                <h3><a href="{{route('artikels.read',[$item->slug])}}">{{$item->judul}}</a> </h3>
                                <small>{{$item->created_at->format('Y-m-d')}}</small>
                                {!! $item->isi_artikel !!}
                            </div>
                        </div>
                    </div>
            @endforeach

        {{ $data->links() }}
    </div>
@endsection
