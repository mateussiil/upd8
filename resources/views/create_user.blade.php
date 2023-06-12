<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create User</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">
        <header class="header">
            <img src="{{ asset('udp8-logo.png') }}" alt="Descrição da Imagem">
        </header>
        <form class="form" action="{{ route('users.store') }}" method="POST" id="create_form">
            @csrf
            <h1>Cadastro Cliente</h1>

            <div class="form-group flex justify-between wrap">
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input class="input" type="text" name="cpf" id="cpf" required>
                </div>

                <div class="input-group">
                    <label for="name">Nome:</label>
                    <input class="input" type="text" name="name" id="name" required>
                </div>

                <div class="input-group">
                    <label for="birthdate">Data de Nascimento:</label>
                    <input class="input" type="date" name="birthdate" id="birthdate" required>
                </div>

                <div class="input-group">
                    <label for="gender">Sexo:</label>

                    <div class="flex-column">
                        <div class="flex input-group">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Masculino</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Feminino</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex form-group justify-between wrap">
                <div class="input-group">
                    <label for="address">Endereço:</label>
                    <input class="input" type="text" name="address" id="address" required>
                </div>

              <div class="input-group">
                <label for="state">Estado:</label>
                <select class="input" id="state" name="state" required>
                    <option value="">Selecione</option>
                    <?php
                    $estados = [
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins'
                    ];

                    foreach ($estados as $sigla => $estado) {
                    echo '<option value="' . $sigla . '">' . $estado . '</option>';
                    }
                    ?>
                </select>
                </div>

                <div class="input-group">
                    <label for="city">Cidade:</label>
                    <input class="input" type="text" name="city" id="city" required>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end btn-group">
                <button type="submit" class="btn btn-primary">Criar Usuário</button>
                <button class="btn" onclick="document.getElementById('create_form').reset()">Limpar</button>
            </div>
        </form>
        <form class="flex justify-end" action="{{ route('users.index') }}" method="GET">
            <button type="submit" class="btn btn-success list__btn-add">Listar todos</button>
        </form>
    </body>
</html>
