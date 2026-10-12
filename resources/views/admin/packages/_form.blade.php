@php
    $editing = isset($package) && $package->exists;
@endphp

<div class="mb-3">
    <label class="form-label">Nama paket</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $package->name) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category" class="form-select" required>
        @foreach (['cinta' => 'Paket Cinta', 'bahagia' => 'Paket Bahagia', 'impian' => 'Paket Impian', 'lainnya' => 'Lainnya'] as $value => $label)
            <option value="{{ $value }}"
                @selected(old('category', $package->category ?: 'lainnya') === $value)>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Harga (angka saja)</label>
    <input type="number" name="price" min="0" class="form-control"
           value="{{ old('price', $package->price) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi paket</label>
    <textarea name="description" rows="4" class="form-control" required>{{ old('description', $package->description) }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Fasilitas (satu fasilitas per baris)</label>
    <textarea name="facilities_text" rows="6" class="form-control"
        placeholder="Dekorasi pelaminan&#10;Rias pengantin&#10;Dokumentasi">{{ old('facilities_text', implode("\n", $package->facilities ?? [])) }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Foto paket</label>
    <input type="file" name="image" class="form-control"
           accept=".jpg,.jpeg,.png,.webp" {{ $editing ? '' : 'required' }}>
    <div class="form-text">JPG, PNG, atau WEBP. Maksimal 5 MB.</div>

    @if ($package->image)
        <img src="{{ asset('storage/'.$package->image) }}"
             class="mt-3 rounded" width="180" alt="Foto paket saat ini">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Urutan tampilan</label>
    <input type="number" name="sort_order" min="0"
           class="form-control"
           value="{{ old('sort_order', $package->sort_order ?? 0) }}">
</div>

<div class="form-check mb-4">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1"
           class="form-check-input" id="is_active"
           @checked((bool) old('is_active', $package->exists ? $package->is_active : true))>
    <label for="is_active" class="form-check-label">
        Tampilkan paket di website publik
    </label>
</div>

<button class="btn btn-dark">Simpan</button>
<a href="{{ route('admin.packages.index') }}"
   class="btn btn-outline-secondary">Batal</a>
