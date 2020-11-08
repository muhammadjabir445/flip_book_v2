<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    @foreach ($data as $item)
        <div class="cetak" style=" border: 1px solid black;
        width: 33%;
        padding: 10px;
        box-sizing: border-box;
        display: inline-block;
        margin-bottom: 2px;">
           Judul Buku : <br> {{$item->aktivasi->book->judul_buku}}
           <br>
           Kode Aktivasi : <br> {{$item->kode}}
           <br>
           Kode Buku : <br> {{$item->aktivasi->book->kode_buku}}
        </div>
    @endforeach
</body>
</html>
