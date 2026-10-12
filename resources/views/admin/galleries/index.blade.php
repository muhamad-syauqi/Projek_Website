@extends('admin.layout')

@section('title', 'Kelola Galeri')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Kelola Galeri</h1>
        <a href="{{ route('admin.galleries.create') }}"
           class="btn btn-dark">+ Tambah Foto</a>
    </div>

    <div class="row g-3">
        @forelse ($galleries as $gallery)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('storage/'.$gallery->image) }}"
                         class="card-img-top" alt="{{ $gallery->title }}"
                         style="height:180px;object-fit:cover">

                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->title }}</h5>
                        <p class="small text-muted">
                            {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                        </p>

                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form class="d-inline" method="POST"
                              action="{{ route('admin.galleries.destroy', $gallery) }}"
                              onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada foto galeri. Tambahkan foto pertama.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">{{ $galleries->links() }}</div>
@endsection
