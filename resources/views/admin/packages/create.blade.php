@extends('admin.layout')

@section('title', 'Tambah Paket')
@section('crumb', 'Admin / Kelola Paket / Tambah')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Tambah Paket</h2>
            <p>Paket akan tampil di website setelah disimpan dan diaktifkan.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.packages._form')
    </form>
@endsection