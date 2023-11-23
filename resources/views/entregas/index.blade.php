<!DOCTYPE html>
<html>

<head>
    <title>Resultados da Pesquisa</title>
</head>

<body>
    <h1>Resultados da Pesquisa</h1>

    @foreach($entregas as $entrega)
        <p>
            <a href="{{ route('entregas.detalhes', $entrega['_id']) }}">
                Detalhes da Entrega #{{ $entrega['_id'] }}
            </a>
        </p>
    @endforeach

</body>

</html>
