<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        a {
            text-decoration: none;
        }
        

        li {
            color: #ffbe6f;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Blog') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: #fff8ed;">
    <nav class="shadow sticky-md-top navbar navbar-expand-lg navbar-light" style="background-color: #ffefd4">
        <div class="container">
            <a href="{{ route('blog.index') }}" class="navbar-brand" style="color: #fc7b13"><b>Kursor Nyasar</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <a class="nav-link" href="{{ route('blog.index') }}">Beranda</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('team.index') }}">Profil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-body-tertiary text-center text-lg-start">
        <p class="text-center p-3">&copy; {{ date('Y') }} Kursor Nyasar </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>