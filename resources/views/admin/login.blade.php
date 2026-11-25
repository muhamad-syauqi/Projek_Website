<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Fahira Wedding</title>
    @include('partials.favicon')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body class="admin-login">
    <div class="lframe">
        <div class="lcard">
            <main class="lpanel">
                <div class="lhead">
                    <h1>Login Administrator</h1>
                    <p>Masuk untuk mengelola konten website.</p>
                </div>

                <form class="lform" method="POST" action="{{ route('admin.login.process') }}" id="login-form">
                    @csrf

                    @if ($errors->any())
                        <div class="lerr" role="alert">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3l10 18H2z"/><path d="M12 10v5M12 18v.5"/>
                            </svg>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="lf">
                        <label for="email">Email</label>
                        <div class="linput">
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="username@gmail.com"
                                   autocomplete="username"
                                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   required autofocus>
                        </div>
                    </div>

                    <div class="lf">
                        <label for="password">Password</label>
                        <div class="linput">
                            <input type="password" id="password" name="password"
                                   class="has-eye {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="Password"
                                   autocomplete="current-password" required>
                            <button type="button" class="eye" id="toggle-pass"
                                    aria-label="Tampilkan password" aria-pressed="false">
                                <svg class="off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M9.9 9.9a3 3 0 1 0 4.2 4.2"/>
                                    <path d="M10.7 5.1A10.4 10.4 0 0 1 12 5c7 0 10 7 10 7a13.2 13.2 0 0 1-1.7 2.7"/>
                                    <path d="M6.6 6.6A13.5 13.5 0 0 0 2 12s3 7 10 7a9.7 9.7 0 0 0 5.4-1.6"/>
                                    <path d="M2 2l20 20"/>
                                </svg>
                                <svg class="on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="lactions">
                        <button class="lbtn" type="submit" id="submit-btn">Masuk</button>
                    </div>
                </form>

                <div class="lform" style="margin-top:0">
                    <a class="lback" href="{{ route('home') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <path d="M16 17l5-5-5-5"/>
                            <path d="M21 12H9"/>
                        </svg>
                        <span>Kembali ke website</span>
                    </a>
                </div>
            </main>
        </div>
    </div>

    <script>
        (function () {
            var input = document.getElementById('password');
            var btn = document.getElementById('toggle-pass');
            var form = document.getElementById('login-form');
            var submit = document.getElementById('submit-btn');

            if (input && btn) {
                btn.addEventListener('click', function () {
                    var show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                    btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                });
            }

            if (form && submit) {
                form.addEventListener('submit', function () {
                    submit.disabled = true;
                });
                // Tombol aktif lagi bila halaman dimuat ulang dari cache (tombol "kembali")
                window.addEventListener('pageshow', function () {
                    submit.disabled = false;
                });
            }
        })();
    </script>
</body>
</html>