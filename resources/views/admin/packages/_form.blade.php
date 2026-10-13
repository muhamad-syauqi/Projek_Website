@php
    $editing = $package->exists;
    $categories = [
        'cinta' => 'Paket Cinta',
        'bahagia' => 'Paket Bahagia',
        'impian' => 'Paket Impian',
        'lainnya' => 'Lainnya',
    ];
@endphp

<div class="fgrid">

    {{-- KOLOM KIRI: informasi paket --}}
    <div class="card fc">
        <h3 class="serif">Informasi paket</h3>

        <div class="f">
            <label for="name">Nama paket <i>*</i></label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $package->name) }}"
                   class="@error('name') invalid @enderror" required>
            @error('name') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="row2">
            <div class="f">
                <label for="category">Kategori <i>*</i></label>
                <select id="category" name="category" class="@error('category') invalid @enderror" required>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('category', $package->category ?: 'lainnya') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category') <div class="msg">{{ $message }}</div> @enderror
            </div>

            <div class="f">
                <label for="price">Harga (angka saja) <i>*</i></label>
                <input type="number" id="price" name="price" min="0"
                       value="{{ old('price', $package->price) }}"
                       class="@error('price') invalid @enderror" required>
                @error('price') <div class="msg">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="f">
            <label for="description">Deskripsi paket <i>*</i></label>
            <textarea id="description" name="description" rows="4"
                      class="@error('description') invalid @enderror" required>{{ old('description', $package->description) }}</textarea>
            @error('description') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="f">
            <label for="facilities_text">Fasilitas</label>
            <textarea id="facilities_text" name="facilities_text" rows="8"
                      class="@error('facilities_text') invalid @enderror"
                      placeholder="Dekorasi pelaminan&#10;Rias pengantin&#10;Dokumentasi">{{ old('facilities_text', implode("\n", $package->facilities ?? [])) }}</textarea>
            <div class="help">Tulis satu fasilitas per baris.</div>
            @error('facilities_text') <div class="msg">{{ $message }}</div> @enderror
        </div>
    </div>

    {{-- KOLOM KANAN: foto + pengaturan --}}
    <div>
        <div class="card fc">
            <h3 class="serif">Foto paket</h3>

            <label class="drop" for="image">
                <img id="preview" alt="Pratinjau foto paket"
                     src="{{ $package->image ? asset('storage/'.$package->image) : '' }}"
                     @if (! $package->image) hidden @endif>

                <div class="ph" id="preview-empty" @if ($package->image) hidden @endif>
                    <x-admin.icon name="img" />
                    <span>Belum ada foto dipilih</span>
                </div>

                <span class="u">
                    <x-admin.icon name="up" />
                    <span id="drop-label">{{ $package->image ? 'Ganti foto' : 'Pilih foto' }}</span>
                </span>

                <div class="help">JPG, PNG, atau WEBP. Maksimal 5 MB.</div>

                <input class="vh" type="file" id="image" name="image"
                       accept=".jpg,.jpeg,.png,.webp" {{ $editing ? '' : 'required' }}>
            </label>
            @error('image') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="card fc" style="margin-top:22px">
            <h3 class="serif">Pengaturan</h3>

            <div class="f">
                <label for="sort_order">Urutan tampilan</label>
                <input type="number" id="sort_order" name="sort_order" min="0"
                       value="{{ old('sort_order', $package->sort_order ?? 0) }}">
                <div class="help">Angka kecil tampil lebih dulu.</div>
            </div>

            <label class="sw" for="is_active">
                <div>
                    <b>Tampilkan di website</b>
                    <small>Paket terlihat oleh pengunjung</small>
                </div>

                <input type="hidden" name="is_active" value="0">
                <input class="vh" type="checkbox" id="is_active" name="is_active" value="1"
                       @checked((bool) old('is_active', $package->exists ? $package->is_active : true))>
                <span class="tg"></span>
            </label>
        </div>
    </div>
</div>

<div class="form-acts">
    <button class="btn btn-wine" type="submit">
        <x-admin.icon name="check" />{{ $editing ? 'Simpan Perubahan' : 'Simpan Paket' }}
    </button>
    <a class="btn btn-line" href="{{ route('admin.packages.index') }}">Batal</a>
</div>

@push('scripts')
    <script>
        (function () {
            var input = document.getElementById('image');
            var preview = document.getElementById('preview');
            var empty = document.getElementById('preview-empty');
            var label = document.getElementById('drop-label');
            if (!input) return;

            input.addEventListener('change', function () {
                var file = input.files && input.files[0];
                if (!file) return;

                preview.src = URL.createObjectURL(file);
                preview.hidden = false;
                if (empty) empty.hidden = true;
                if (label) label.textContent = 'Ganti foto';
            });
        })();
    </script>
@endpush