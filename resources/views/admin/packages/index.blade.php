@extends('admin.layout')

@section('title', 'Kelola Paket')
@section('crumb', 'Admin / Kelola Paket')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Kelola Paket Wedding</h2>
            <p>Atur paket yang tampil di halaman Paket dan Detail Paket.</p>
        </div>

        <a class="btn btn-wine" href="{{ route('admin.packages.create') }}">
            <x-admin.icon name="plus" />Tambah Paket
        </a>
    </div>

    <div class="card">
        {{-- Pencarian dan filter --}}
        <form class="bar" method="GET" action="{{ route('admin.packages.index') }}">
            <label class="search">
                <x-admin.icon name="search" />
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Cari nama paket…" aria-label="Cari nama paket">
            </label>

            <select class="sel" name="category" aria-label="Filter kategori" onchange="this.form.submit()">
                <option value="">Semua kategori</option>
                @foreach (['cinta' => 'Cinta', 'bahagia' => 'Bahagia', 'impian' => 'Impian', 'lainnya' => 'Lainnya'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('category') === $value)>{{ $label }}</option>
                @endforeach
            </select>

            <select class="sel" name="status" aria-label="Filter status" onchange="this.form.submit()">
                <option value="">Semua status</option>
                <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(request('status') === 'nonaktif')>Nonaktif</option>
            </select>
        </form>

        <div class="tbl">
            <table>
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Paket</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="text-align:center">Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td style="width:110px">
                                @if ($package->image)
                                    <img class="thumb" src="{{ asset('storage/'.$package->image) }}" alt="{{ $package->name }}">
                                @else
                                    <div class="nophoto">Belum ada foto</div>
                                @endif
                            </td>
                            <td class="name">
                                <b>{{ $package->name }}</b>
                                <small>/paket/{{ $package->slug }}</small>
                            </td>
                            <td><span class="cat">{{ ucfirst($package->category) }}</span></td>
                            <td class="price">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td style="text-align:center;font-weight:700;color:var(--muted)">{{ $package->sort_order }}</td>
                            <td>
                                <span class="pill {{ $package->is_active ? 'on' : 'off' }}">
                                    {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td style="width:110px">
                                <div class="acts">
                                    <a class="iconbtn" href="{{ route('admin.packages.edit', $package) }}"
                                       aria-label="Edit {{ $package->name }}" title="Edit">
                                        <x-admin.icon name="edit" />
                                    </a>

                                    <form method="POST" action="{{ route('admin.packages.destroy', $package) }}"
                                          onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="iconbtn del" type="submit"
                                                aria-label="Hapus {{ $package->name }}" title="Hapus">
                                            <x-admin.icon name="trash" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                @if (request()->hasAny(['q', 'category', 'status']))
                                    Tidak ada paket yang cocok dengan pencarian.
                                @else
                                    Belum ada paket. Klik Tambah Paket untuk mulai.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pg">
            <span>
                @if ($packages->total() > 0)
                    Menampilkan {{ $packages->firstItem() }}–{{ $packages->lastItem() }} dari {{ $packages->total() }} paket
                @else
                    0 paket
                @endif
            </span>
            {{ $packages->links('vendor.pagination.admin') }}
        </div>
    </div>
@endsection