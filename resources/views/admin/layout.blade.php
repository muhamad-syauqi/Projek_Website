<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Fahira Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                Fahira Wedding Admin
            </a>

            <div class="d-flex gap-3 align-items-center">
                <a href="{{ route('admin.packages.index') }}"
                   class="text-white text-decoration-none">Paket</a>

                <a href="{{ route('admin.galleries.index') }}"
                   class="text-white text-decoration-none">Galeri</a>

                <a href="{{ route('home') }}"
                   class="text-white text-decoration-none">Website</a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
