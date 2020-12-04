<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>

<body>
    @php
        $awal = 0;
    @endphp
    <table style="width:100%;border-collapse: separate;
    border-spacing: 15px;">
        @foreach ($data as $item)
            @if ($awal == 0)

            <tr style="">
            @endif
                <td style="border: 1px solid black; padding:20px">
                    Judul Buku :  {{$item->aktivasi->book->judul_buku}}
                    <br>
                    Kode Aktivasi :  {{$item->kode}}
                    <br>
                    Kode Buku :  {{$item->aktivasi->book->kode_buku}}
                </td>
            @if ($awal == 2)
             </tr>
            @endif
            @php
                  $awal++;
            @endphp

            @if ($awal >= 2)
                @php
                    $awal=0;
                @endphp
            @endif

        @endforeach

    </table>

</body>
</html>
