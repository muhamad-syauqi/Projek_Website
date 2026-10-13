@extends('admin.layout')

@section('title', 'Kelola Galeri')
@section('crumb', 'Admin / Kelola Galeri')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Kelola Galeri</h2>
            <p>Foto yang aktif akan tampil di halaman Galeri website.</p>
        </div>

        <a class="btn btn-wine" href="{{ route('admin.galleries.create') }}">
            <x-admin.icon name="plus" />Tambah Foto
        </a>
    </div>

    {{-- Tab filter --}}
    <div class="tabs">
        <a href="{{ route('admin.galleries.index') }}" class="{{ ! $status ? 'on' : '' }}">
            Semua ({{ $counts['semua'] }})
        </a>
        <a href="{{ route('admin.galleries.index', ['status' => 'aktif']) }}" class="{{ $status === 'aktif' ? 'on' : '' }}">
            Aktif ({{ $counts['aktif'] }})
        </a>
        <a href="{{ route('admin.galleries.index', ['status' => 'nonaktif']) }}" class="{{ $status === 'nonaktif' ? 'on' : '' }}">
            Nonaktif ({{ $counts['nonaktif'] }})
        </a>
    </div>

    @if ($galleries->isEmpty())
        <div class="card empty">
            @if ($status)
                Tidak ada foto pada filter ini.
            @else
                Belum ada foto galeri. Tambahkan foto pertama.
            @endif
        </div>
    @else
        <div class="ggrid">
            @foreach ($galleries as $gallery)
                <div class="card g">
                    <div class="im">
                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}" loading="lazy">
                        <span class="pill badge {{ $gallery->is_active ? 'on' : 'off' }}">
                            {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    <div class="gb">
                        <b>{{ $gallery->title }}</b>
                        <small>{{ $gallery->taken_at ? $gallery->taken_at->locale('id')->translatedFormat('F Y') : 'Tanpa tanggal' }} · Urutan {{ $gallery->sort_order }}</small>

                        <div class="ga">
                            <a class="btn btn-line sm" href="{{ route('admin.galleries.edit', $gallery) }}">
                                <x-admin.icon name="edit" />Edit
                            </a>

                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="iconbtn del" type="submit"
                                        aria-label="Hapus {{ $gallery->title }}" title="Hapus">
                                    <x-admin.icon name="trash" />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pager-wrap">
            {{ $galleries->links('vendor.pagination.admin') }}
        </div>
    @endif
@endsection