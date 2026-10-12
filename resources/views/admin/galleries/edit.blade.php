@extends('admin.layout')

@section('title', 'Edit Foto Galeri')

@section('content')
    <h1 class="h3 mb-4">Edit Foto Galeri</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.galleries.update', $gallery) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul foto</label>
                    <input name="title" class="form-control"
                           value="{{ old('title', $gallery->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control"
                              rows="3">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti foto (opsional)</label>
                    <input type="file" name="image" class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">
                    <img src="{{ asset('storage/'.$gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="mt-3 rounded" width="200">
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan tampilan</label>
                    <input type="number" name="sort_order" min="0"
                           class="form-control"
                           value="{{ old('sort_order', $gallery->sort_order) }}">
                </div>

                <div class="form-check mb-4">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           id="is_active" class="form-check-input"
                           @checked((bool) old('is_active', $gallery->is_active))>
                    <label for="is_active" class="form-check-label">
                        Tampilkan di website
                    </label>
                </div>

                <button class="btn btn-dark">Simpan Perubahan</button>
                <a href="{{ route('admin.galleries.index') }}"
                   class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
