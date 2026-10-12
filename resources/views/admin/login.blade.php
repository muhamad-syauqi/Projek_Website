<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Fahira Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="width:100%;max-width:420px">
            <h2 class="text-center mb-2">Fahira Wedding</h2>
            <p class="text-center text-muted mb-4">Login Administrator</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email admin</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control" required>
                </div>

                <button class="btn btn-dark w-100" type="submit">
                    Masuk
                </button>
            </form>

            <a href="{{ route('home') }}"
               class="text-center mt-3 text-decoration-none">
                Kembali ke website
            </a>
        </div>
    </div>
</body>
</html>
