<!-- user.blade.php -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Detalhes do Usuário</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <header class="header">
            <img src="{{ asset('udp8-logo.png') }}" alt="Descrição da Imagem">
        </header>
        <div class="user-info">

            <h1>Detalhes do Usuário</h1>

            <table>
                <tr>
                    <th>Nome:</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>CPF:</th>
                    <td>{{ $user->cpf }}</td>
                </tr>
                <tr>
                    <th>Data de Nascimento:</th>
                    <td>{{ $user->birthdate }}</td>
                </tr>
                <tr>
                    <th>Gênero:</th>
                    <td>{{ $user->gender }}</td>
                </tr>
                <tr>
                    <th>Endereço:</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>{{ $user->state }}</td>
                </tr>
                <tr>
                    <th>Cidade:</th>
                    <td>{{ $user->city }}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
