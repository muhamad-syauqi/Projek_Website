<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Fahira Wedding</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Alegreya+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin admin-login">
    <div class="lwrap">

        <div class="l">
            <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">

            <div>
                <h2 class="serif">Kelola momen<br>bahagia setiap pasangan</h2>
                <p>Atur paket pernikahan dan galeri Fahira Wedding dengan mudah dari satu tempat.</p>
            </div>

            <small>&copy; {{ date('Y') }} Fahira Wedding</small>
        </div>

        <div class="r">
            <div class="card box">
                <div class="gold"></div>
                <h1 class="serif">Login Administrator</h1>
                <p>Masuk untuk mengelola konten website.</p>

                @if ($errors->any())
                    <div class="alert bad">
                        <x-admin.icon name="warn" />
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.process') }}">
                    @csrf

                    <div class="f">
                        <label for="email">Email admin</label>
                        <div class="inw">
                            <x-admin.icon name="mail" />
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="admin@fahirawedding.com"
                                   autocomplete="username" required autofocus>
                        </div>
                    </div>

                    <div class="f">
                        <label for="password">Password</label>
                        <div class="inw">
                            <x-admin.icon name="lock" />
                            <input type="password" id="password" name="password"
                                   class="hasEye" placeholder="Masukkan password"
                                   autocomplete="current-password" required>
                            <button type="button" class="eye" id="toggle-pass"
                                    aria-label="Tampilkan password">
                                <x-admin.icon name="eye" />
                            </button>
                        </div>
                    </div>

                    <button class="btn btn-wine" type="submit">Masuk</button>
                </form>

                <a class="bk" href="{{ route('home') }}">
                    <x-admin.icon name="arrow" />Kembali ke website
                </a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            var input = document.getElementById('password');
            var btn = document.getElementById('toggle-pass');
            if (!input || !btn) return;
            btn.addEventListener('click', function () {
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        })();
    </script>
</body>
</html>