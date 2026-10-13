<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Fahira Wedding</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400;500;600;700&family=Alegreya+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin">
    @php
        $user = auth()->user();
        $initials = collect(preg_split('/\s+/', trim($user->name)))
            ->take(2)
            ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
            ->join('');
    @endphp

    <div class="app" id="app">

        {{-- SIDEBAR --}}
        <aside class="side" id="side">
            <div class="brand">
                <img src="{{ asset('images/logo-fahira.png') }}" alt="Fahira Wedding">
                <small>Panel Admin</small>
            </div>

            <div class="side-label">Menu utama</div>
            <nav class="nav" aria-label="Menu admin">
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'on' : '' }}">
                    <x-admin.icon name="dash" /><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.packages.index') }}"
                   class="{{ request()->routeIs('admin.packages.*') ? 'on' : '' }}">
                    <x-admin.icon name="pkg" /><span>Kelola Paket</span>
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                   class="{{ request()->routeIs('admin.galleries.*') ? 'on' : '' }}">
                    <x-admin.icon name="img" /><span>Kelola Galeri</span>
                </a>
            </nav>

            <div class="side-foot">
                <a href="{{ route('home') }}" target="_blank" rel="noopener">
                    <x-admin.icon name="web" /><span>Lihat Website</span>
                </a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="out">
                        <x-admin.icon name="out" /><span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="scrim" id="scrim"></div>

        {{-- KONTEN --}}
        <div class="main">
            <header class="top">
                <div class="top-left">
                    <button class="menu-btn" id="menu-btn" type="button" aria-label="Buka menu">
                        <x-admin.icon name="menu" />
                    </button>
                    <div>
                        <div class="crumb">@yield('crumb', 'Admin')</div>
                        <h1 class="serif">@yield('title', 'Admin')</h1>
                    </div>
                </div>

                <div class="user">
                    <div>
                        <b>{{ $user->name }}</b>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="av">{{ $initials }}</div>
                </div>
            </header>

            <main class="content">
                @if (session('success'))
                    <div class="alert ok">
                        <x-admin.icon name="check" />
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert bad">
                        <x-admin.icon name="warn" />
                        <div>
                            Data belum bisa disimpan, periksa kembali isian Anda:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            var app = document.getElementById('app');
            var btn = document.getElementById('menu-btn');
            var scrim = document.getElementById('scrim');
            if (!app || !btn) return;
            btn.addEventListener('click', function () { app.classList.toggle('open'); });
            scrim.addEventListener('click', function () { app.classList.remove('open'); });
        })();
    </script>
    @stack('scripts')
</body>
</html>