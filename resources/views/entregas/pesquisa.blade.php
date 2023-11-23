<!DOCTYPE html>
<html>
<head>
    <title>Pesquisa por CPF</title>
</head>
<body>
    <h1>Pesquisa por CPF</h1>

    <form method="post" action="{{ route('entregas.pesquisar') }}">
        @csrf
        <label for="cpf">Digite o CPF:</label>
        <input type="text" name="cpf" required>
        <button type="submit">Pesquisar</button>
    </form>
</body>
</html>
