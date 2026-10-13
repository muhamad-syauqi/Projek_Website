@extends('admin.layout')

@section('title', 'Tambah Foto Galeri')
@section('crumb', 'Admin / Kelola Galeri / Tambah')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Tambah Foto Galeri</h2>
            <p>Foto akan tampil di halaman Galeri setelah disimpan dan diaktifkan.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.galleries._form')
    </form>
@endsection