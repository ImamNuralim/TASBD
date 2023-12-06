@extends('sopir.layout')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Tambah Sopir</h5>
        <form method="post" action="{{ route('sopir.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_sopir" class="form-label">ID Sopir</label>
                <input type="text" class="form-control" id="id_sopir" name="id_sopir">
            </div>
            <div class="mb-3">
                <label for="nama_sopir" class="form-label">Nama Sopir</label>
                <input type="text" class="form-control" id="nama_sopir" name="nama_sopir">
            </div>
            <div class="mb-3">
                <label for="alamat_sopir" class="form-label">Alamat Sopir</label>
                <input type="text" class="form-control" id="alamat_sopir" name="alamat_sopir">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop