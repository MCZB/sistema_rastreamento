<!DOCTYPE html>
<html>
<head>
    <title>Detalhes da Entrega</title>
</head>
<body>
    <h1>Detalhes da Entrega</h1>

    <p>ID da Entrega: {{ $entrega['_id'] }}</p>
    <p>Volumes: {{ $entrega['_volumes'] }}</p>

    <h2>Detalhes da Transportadora</h2>
    <p>Transportadora: {{ $transportadora['_fantasia'] }}</p>
    <p>CNPJ: {{ $transportadora['_cnpj'] }}</p>

    <h3>Remetente</h3>
    <p>Nome: {{ $entrega['_remetente']['_nome'] }}</p>

    <h3>Destinatário</h3>
    <p>Nome: {{ $entrega['_destinatario']['_nome'] }}</p>
    <p>CPF: {{ $entrega['_destinatario']['_cpf'] }}</p>
    <p>Endereço: {{ $entrega['_destinatario']['_endereco'] }}</p>
    <p>Estado: {{ $entrega['_destinatario']['_estado'] }}</p>
    <p>CEP: {{ $entrega['_destinatario']['_cep'] }}</p>
    <p>País: {{ $entrega['_destinatario']['_pais'] }}</p>

    <h3>Geolocalização</h3>
    <p>Latitude: {{ $entrega['_destinatario']['_geolocalizao']['_lat'] }}</p>
    <p>Longitude: {{ $entrega['_destinatario']['_geolocalizao']['_lng'] }}</p>

    <h3>Rastreamento</h3>
    @foreach ($entrega['_rastreamento'] as $rastreamento)
        <p>Mensagem: {{ $rastreamento['message'] }}</p>
        <p>Data: {{ $rastreamento['date'] }}</p>
        <hr>
    @endforeach
</body>
</html>
