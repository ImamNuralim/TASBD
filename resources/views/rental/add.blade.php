@extends('rental.layout')
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
        <h5 class="card-title fw-bolder mb-3">Tambah Rental</h5>
        <form method="post" action="{{ route('rental.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_rental" class="form-label">ID Rental</label>
                <input type="text" class="form-control" id="id_rental" name="id_rental">
            </div>
            <div class="mb-3">
                <label for="id_customer" class="form-label">ID Customer</label>
                <input type="text" class="form-control" id="id_customer" name="id_customer">
            </div>
            <div class="mb-3">
                <label for="id_motor" class="form-label">ID motor</label>
                <input type="text" class="form-control" id="id_motor" name="id_motor">
            </div>
            <div class="mb-3">
                <label for="id_sopir" class="form-label">ID Sopir</label>
                <input type="text" class="form-control" id="id_sopir" name="id_sopir">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="mb-3">
                <label for="tgl_rental" class="form-label">Tanggal Rental</label>
                <input type="date" class="form-control" id="tgl_rental" name="tgl_rental">
            </div>
            <div class="mb-3">
                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop