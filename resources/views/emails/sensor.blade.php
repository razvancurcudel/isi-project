<html>
    <body>
        Senzorul de la {{ $sensor->collection_point }} ({{$sensor->long}}, {{$sensor->lat}}), a raportat un nivel crescut de <b>{{ $overflowParam["name"] }}</b>, acesta atingand valoarea de <i>{{ $overflowParam["value"] }}</i>.
    </body>
</html>