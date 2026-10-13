@extends('admin.layout')

@section('title', 'Edit Foto Galeri')
@section('crumb', 'Admin / Kelola Galeri / Edit')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Edit Foto Galeri</h2>
            <p>Perubahan akan tampil di website setelah disimpan.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.galleries._form')
    </form>
@endsection