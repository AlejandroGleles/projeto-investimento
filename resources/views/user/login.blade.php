<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Investindo</title>
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <div class="background"></div>
    <section id="conteudo-view" class="login">
        <h1>Investindo</h1>
        <h3>O nosso gerenciador de investimento</h3>

        <!-- Exibição de mensagens de erro -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.login') }}" method="post">
            @csrf
            <p>Acesse o sistema</p>
            <label>
                <input type="text" name="username" class="input" placeholder="Usuário" />
            </label>
            <label>
                <input type="password" name="password" placeholder="Senha" />
            </label>
            <button type="submit">Entrar</button>
        </form>
    </section>
</body>
</html>
