@extends('admin.layout')

@section('title', 'Edit Paket')
@section('crumb', 'Admin / Kelola Paket / Edit')

@section('content')
    <div class="page-head">
        <div>
            <h2 class="serif">Edit Paket</h2>
            <p>Perubahan akan tampil di website setelah disimpan.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.packages._form')
    </form>
@endsection