<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>

<body>
    @php
        $awal = 0;
    @endphp
    <table style="width:100%;
    border-spacing: 30px; color:white">
        @foreach ($data as $item)
            @if ($awal == 0)

            <tr style="">
            @endif
                <td style="padding:20px; height:245px; background-repeat: no-repeat;" background="{{asset('kode.png')}}">

                    <h2>{{$item->kode}}</h2>

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
