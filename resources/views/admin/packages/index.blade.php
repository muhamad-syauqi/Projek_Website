@extends('admin.layout')

@section('title', 'Kelola Paket')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Kelola Paket Wedding</h1>
        <a href="{{ route('admin.packages.create') }}"
           class="btn btn-dark">+ Tambah Paket</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nama Paket</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td>
                                @if ($package->image)
                                    <img src="{{ asset('storage/'.$package->image) }}"
                                         width="75" height="55"
                                         style="object-fit:cover" alt="">
                                @else
                                    <span class="text-muted">Belum ada foto</span>
                                @endif
                            </td>
                            <td>{{ $package->name }}</td>
                            <td>{{ ucfirst($package->category) }}</td>
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>
                                @if ($package->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.packages.edit', $package) }}"
                                       class="btn btn-sm btn-warning">Edit</a>

                                    <form method="POST"
                                          action="{{ route('admin.packages.destroy', $package) }}"
                                          onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Belum ada paket. Klik Tambah Paket untuk mulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $packages->links() }}</div>
@endsection
