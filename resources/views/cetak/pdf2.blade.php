<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .cetak {
            border: 1px solid black;
            width: 33%;
            padding: 10px;
            box-sizing: border-box;
            display: inline-block;
            margin-bottom: 2px;
        }
    </style>
</head>
<body>
    @foreach ($data['aktivasi'] as $item)
        <div class="cetak">
           Judul Buku : <br>{{$data['judul_buku']}}
           <br>
           Kode Aktivasi : <br> {{$item['kode']}}
           <br>
           Kode Buku : <br> {{$data['kode_buku']}}
        </div>
    @endforeach
</body>
</html>
