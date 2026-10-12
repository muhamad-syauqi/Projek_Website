@extends('admin.layout')

@section('title', 'Edit Paket')

@section('content')
    <h1 class="h3 mb-4">Edit Paket</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.packages.update', $package) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.packages._form')
            </form>
        </div>
    </div>
@endsection
