@extends('layouts.app')



@section('content')
    <div class="container mt-4 mb-4">
        <form class="form-inline" method="get" action="{{route('buku-list')}}" >

            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only">Judul Buku</label>
              <input type="text" class="form-control form-control-sm" id="inputPassword2" name="keyword">
            </div>
            <div class="form-group mb-2">
                <select class="form-control form-control-sm" name="category">
                    <option value="">Semua</option>
                    @foreach ($category as $value)
                    <option value="{{$value->id}}">{{$value->description}}</option>

                    @endforeach
                  </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm ml-3" style="margin-top:-10px">Cari</button>
        </form>
        <div class="row">
            @foreach ($buku as $item)
            @php
                  $direktori = explode('/',$item->folder);
                    $direktori = array_key_exists(1,$direktori) ? $direktori[1] : '';
            @endphp
                <div class="col-12 col-md-4">
                    <div class="p-2 bg-white">
                        <div class="row">
                            <div class="col-4">
                                @if (\File::exists(public_path('storage/' . $item->folder . "/{$direktori}" . "-0.jpg")))
                                    <img src="data:image/png;base64,{{base64_encode(file_get_contents(public_path('storage/' . $item->folder . "/{$direktori}" . "-0.jpg")))}}" class="img-thumbnail" alt="{{$item->judul_buku}}">

                                @else
                                <img src="">

                                @endif
                                @if ($item->category)
                                 @php
                                    if($item->category->description == 'SD') {
                                        $warna = 'danger';
                                    } else if($item->category->description == 'SMP') {
                                        $warna = 'primary';

                                    } else {
                                        $warna = 'info';
                                    }
                                @endphp
                                <span class="badge badge-{{$warna}} span-list-buku">{{$item->category->description}}</span>
                                @endif

                            </div>
                            <div class="col-8">
                                <p>{{$item->judul_buku}}</p>
                                <p>Rp. {{number_format($item->harga)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $buku->links() }}
    </div>
@endsection
