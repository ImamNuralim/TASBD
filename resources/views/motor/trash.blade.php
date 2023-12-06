@extends('motor.layout')
@section('content')
<a href="{{ route('rental.index') }}" type="button" class="btn btn rounded-3">Data Rental</a>
<a href="{{ route('customer.index') }}" type="button" class="btn btn rounded-3">Data Customer</a>
<a href="{{ route('motor.index') }}" type="button" class="btn btn rounded-3">Data motor</a>
<a href="{{ route('sopir.index') }}" type="button" class="btn btn rounded-3">Data Sopir</a>
<a href="{{ route('home.index') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
<div style="margin-top: 20px">
    <div style="margin-bottom: +45px">
        <div style="float:right">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('motor.index') }}" type="button">Data motor</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('motor.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<h4 class="mt-5">Data Trash motor</h4>
<div class="form-search" style="float:right">
    <form action="{{ route('motor.search_trash') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="text" id="nama_motor" name="nama_motor" class="form-control" placeholder="Nama motor">
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
            <th>Nama motor</th>
            <th>Tipe motor</th>
            <th>Dihapus Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_motor }}</td>
            <td>{{ $data->nama_motor }}</td>
            <td>{{ $data->tipe_motor }}</td>
            <td>{{ $data->deleted_at }}</td>
            <td style="float:right">
                <a href="{{ route('motor.restore', $data->id_motor) }}" type="button"
                    class="btn btn-success rounded-3">Restore</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->id_motor }}">
                    Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->id_motor }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('motor.delete', $data->id_motor) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop