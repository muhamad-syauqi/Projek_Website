@extends('admin.layout')

@section('title', 'Tambah Foto Galeri')

@section('content')
    <h1 class="h3 mb-4">Tambah Foto Galeri</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.galleries.store') }}"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul foto</label>
                    <input name="title" class="form-control"
                           value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control"
                              rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih foto</label>
                    <input type="file" name="image" class="form-control"
                           accept=".jpg,.jpeg,.png,.webp" required>
                    <div class="form-text">Format gambar, maksimal 5 MB.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan tampilan</label>
                    <input type="number" name="sort_order"
                           class="form-control" min="0" value="0">
                </div>

                <div class="form-check mb-4">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           id="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">
                        Tampilkan di website
                    </label>
                </div>

                <button class="btn btn-dark">Simpan Foto</button>
                <a href="{{ route('admin.galleries.index') }}"
                   class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
