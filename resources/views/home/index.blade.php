@extends('home.layout')
@section('content')
<a href="{{ route('login.create') }}" type="button" class="btn btn rounded-3">Login</a>
<h4 class="mt-5">Data Rental</h4>
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No Rental</th>
            <th>Nama Customer</th>
            <th>Nama motor</th>
            <th>Nama Sopir</th>
            <th>Harga</th>
            <th>Tanggal Rental</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_rental }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->nama_motor }}</td>
            <td>{{ $data->nama_sopir }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->tgl_rental }}</td>
            <td>{{ $data->tgl_kembali }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop