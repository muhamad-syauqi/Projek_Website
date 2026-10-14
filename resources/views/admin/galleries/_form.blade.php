@php
    $editing = $gallery->exists;
@endphp

<div class="fgrid">

    {{-- KOLOM KIRI --}}
    <div class="card fc">
        <h3 class="serif">Informasi foto</h3>

        <div class="f">
            <label for="title">Nama pasangan <i>*</i></label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $gallery->title) }}"
                   placeholder="Contoh: Mawar & Zaki"
                   class="@error('title') invalid @enderror" required>
            @error('title') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="f">
            <label for="venue">Tempat pernikahan</label>
            <input type="text" id="venue" name="venue"
                   value="{{ old('venue', $gallery->venue) }}"
                   placeholder="Contoh: Graha Sativa"
                   class="@error('venue') invalid @enderror">
            @error('venue') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="f">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="5"
                      class="@error('description') invalid @enderror">{{ old('description', $gallery->description) }}</textarea>
            @error('description') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <div class="f">
            <label for="sort_order">Urutan tampilan</label>
            <input type="number" id="sort_order" name="sort_order" min="0"
                   value="{{ old('sort_order', $gallery->sort_order ?? 0) }}">
            <div class="help">Angka kecil tampil lebih dulu.</div>
        </div>

        <div class="f">
            <label for="taken_at">Tanggal acara <i>*</i></label>
            <input type="date" id="taken_at" name="taken_at"
                   value="{{ old('taken_at', $gallery->taken_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                   class="@error('taken_at') invalid @enderror" required>
            <div class="help">Bulan dari tanggal ini dipakai sebagai filter di halaman Galeri.</div>
            @error('taken_at') <div class="msg">{{ $message }}</div> @enderror
        </div>

        <label class="sw" for="is_active">
            <div>
                <b>Tampilkan di website</b>
                <small>Foto terlihat oleh pengunjung</small>
            </div>

            <input type="hidden" name="is_active" value="0">
            <input class="vh" type="checkbox" id="is_active" name="is_active" value="1"
                   @checked((bool) old('is_active', $gallery->exists ? $gallery->is_active : true))>
            <span class="tg"></span>
        </label>
    </div>

    {{-- KOLOM KANAN: foto --}}
    <div class="card fc">
        <h3 class="serif">Foto</h3>

        <label class="drop" for="image">
            <img id="preview" alt="Pratinjau foto galeri"
                 src="{{ $gallery->image ? asset('storage/'.$gallery->image) : '' }}"
                 @if (! $gallery->image) hidden @endif>

            <div class="ph" id="preview-empty" @if ($gallery->image) hidden @endif>
                <x-admin.icon name="img" />
                <span>Belum ada foto dipilih</span>
            </div>

            <span class="u">
                <x-admin.icon name="up" />
                <span id="drop-label">{{ $gallery->image ? 'Ganti foto' : 'Pilih foto' }}</span>
            </span>

            <div class="help">JPG, PNG, atau WEBP. Maksimal 5 MB.</div>

            <input class="vh" type="file" id="image" name="image"
                   accept=".jpg,.jpeg,.png,.webp" {{ $editing ? '' : 'required' }}>
        </label>
        @error('image') <div class="msg">{{ $message }}</div> @enderror
    </div>
</div>

<div class="form-acts">
    <button class="btn btn-wine" type="submit">
        <x-admin.icon name="check" />{{ $editing ? 'Simpan Perubahan' : 'Simpan Foto' }}
    </button>
    <a class="btn btn-line" href="{{ route('admin.galleries.index') }}">Batal</a>
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