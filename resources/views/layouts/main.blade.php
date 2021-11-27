<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda Online</title>

    <!-- Bootstrap 5.0.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <main class="col-xl-4 offset-xl-4 col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 pt-3 pb-3 d-flex flex-column">
        @if ( Auth::check() )
            <header class="d-flex flex-row align-items-center justify-content-between mb-5">
                <h6>Logado como <span class="text-secondary">{{ Auth::user()->name }}</span></h6>
                <a href="/user/logout" class="text-danger">Logout</a>
            </header>
        @endif

        @yield('title')

        @if ($errors->any())
            <div class="alert alert-danger">
                <p class="mb-0">{{ $errors->first() }}</p>
            </div>
        @endif

        @yield('content')

        <footer class="pt-3 text-center">
            <small>Todos os direitos reservados</small>
        </footer>
    </main>
</body>
</html>