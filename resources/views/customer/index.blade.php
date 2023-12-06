@extends('customer.layout')
@section('content')
<a href="{{ route('rental.index') }}" type="button" class="btn btn rounded-3">Data Rental</a>
<a href="{{ route('customer.index') }}" type="button" class="btn btn rounded-3">Data Customer</a>
<a href="{{ route('motor.index') }}" type="button" class="btn btn rounded-3">Data motor</a>
<a href="{{ route('sopir.index') }}" type="button" class="btn btn rounded-3">Data Sopir</a>
<a href="{{ route('home.index') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
<div style="margin-top: 20px">
    <div style="margin-bottom: +45px">
        <div style="float:right">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('customer.index') }}" type="button">Data Customer</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('customer.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<h4 class="mt-5">Data Customer</h4>
<a href="{{ route('customer.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<div class="form-search" style="float:right">
    <form action="{{ route('customer.search') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="search" id="nama" name="nama" class="form-control" placeholder="Nama Customer">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>
</div>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Customer</th>
            <th>Alamat Customer</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_customer }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->alamat }}</td>
            <td style="float:right">
                <a href="{{ route('customer.edit', $data->id_customer) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <a href="{{ route('customer.hide', $data->id_customer) }}" type="button"
                    class="btn btn-danger rounded-3">Hapus</a>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop