@extends('motor.layout')
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
        <h5 class="card-title fw-bolder mb-3">Tambah motor</h5>
        <form method="post" action="{{ route('motor.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_motor" class="form-label">ID motor</label>
                <input type="text" class="form-control" id="id_motor" name="id_motor">
            </div>
            <div class="mb-3">
                <label for="nama_motor" class="form-label">Nama motor</label>
                <input type="text" class="form-control" id="nama_motor" name="nama_motor">
            </div>
            <div class="mb-3">
                <label for="tipe_motor" class="form-label">Tipe motor</label>
                <input type="text" class="form-control" id="tipe_motor" name="tipe_motor">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop