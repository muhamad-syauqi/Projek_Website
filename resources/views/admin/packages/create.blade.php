@extends('admin.layout')

@section('title', 'Tambah Paket')

@section('content')
    <h1 class="h3 mb-4">Tambah Paket</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.packages.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @include('admin.packages._form')
            </form>
        </div>
    </div>
@endsection
