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
    @php
        $awal = 0;
    @endphp
    <table style="border: 1px solid black;width:100%; border-collapse: collapse;">
        @foreach ($data as $item)
            @if ($awal == 0)

            <tr style="border: 1px solid black;">
            @endif
                <td style="border: 1px solid black;">
                    Judul Buku : <br> {{$item->aktivasi->book->judul_buku}}
                    <br>
                    Kode Aktivasi : <br> {{$item->kode}}
                    <br>
                    Kode Buku : <br> {{$item->aktivasi->book->kode_buku}}
                </td>
            @if ($awal == 0)
             </tr>
            @endif
            @php
                  $awal++;
            @endphp

            @if ($awal >= 3)
                @php
                    $awal=0;
                @endphp
            @endif

        @endforeach

    </table>
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
