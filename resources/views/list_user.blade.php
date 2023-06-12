<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Users</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <script>
        function clearQueryParams() {
            var urlSemParams = window.location.href.split('?')[0];
            window.location.href = urlSemParams;
        }

        function deleteUser(userId) {
            if (confirm('Deseja realmente excluir o usuário?')) {
                window.location.href = "{{ url('users') }}/" + userId + "/delete";
            }
        }
    </script>
    <body class="antialiased">
        <header class="header">
            <img src="{{ asset('udp8-logo.png') }}" alt="Descrição da Imagem">
        </header>
        <form class="form" action="{{ route('users.index') }}" method="GET">
            @csrf
            <h1>Consulta Cliente</h1>

            <div class="form-group flex justify-between wrap">
                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input class="input" type="text" name="cpf" id="cpf" value="{{ request()->get('cpf') }}">
                </div>

                <div class="input-group">
                    <label for="name">Nome:</label>
                    <input class="input" type="text" name="name" id="name" value="{{ request()->get('name') }}">
                </div>

                <div class="input-group">
                    <label for="birthdate">Data de Nascimento:</label>
                    <input class="input" type="date" name="birthdate" id="birthdate" value="{{ request()->get('birthdate') }}">
                </div>

                <div class="input-group">
                    <label for="gender">Sexo:</label>

                    <div class="flex-column">
                        <div class="flex input-group">
                            <input type="radio" id="male" name="gender" value="male" {{ request()->get('gender') === 'male' ? 'checked' : '' }}>
                            <label for="male">Masculino</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" id="female" name="gender" value="female" {{ request()->get('gender') === 'female' ? 'checked' : '' }}>
                            <label for="female">Feminino</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex form-group justify-between wrap">
                <div class="input-group">
                    <label for="address">Endereço:</label>
                    <input class="input" type="text" name="address" id="address" value="{{ request()->get('address') }}">
                </div>

                <div class="input-group">
                    <label for="state">Estado:</label>
                    <select class="input" id="state" name="state">
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
                            $selected = request()->get('state') === $sigla ? 'selected' : '';
                            echo '<option value="' . $sigla . '" ' . $selected . '>' . $estado . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="city">Cidade:</label>
                    <input class="input" type="text" name="city" id="city" value="{{ request()->get('city') }}">
                </div>
            </div>

            <div class="flex justify-end btn-group">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
                <button type="reset" class="btn" onclick="clearQueryParams()">Limpar</button>
            </div>
        </form>

        <div class="user-info">
            <form class="flex justify-end" action="{{ route('users.create') }}" method="GET">
                <button type="submit" class="btn btn-success list__btn-add">Adicionar</button>
            </form>

            @if ($users->isEmpty())
                <p>Nenhum usuário encontrado.</p>
            @else
                <table class="user-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data Nasc.</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-success">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $user['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warn">Excluir</button>
                                    </form>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->cpf }}</td>
                                <td>{{ $user->birthdate }}</td>
                                <td>{{ $user->state }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->onEachSide(2)->appends(request()->query())->links('pagination.custom') }}
            @endif
        </div>
    </body>
</html>
