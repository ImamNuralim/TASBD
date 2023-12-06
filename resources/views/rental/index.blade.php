@extends('rental.layout')
@section('content')
<a href="{{ route('rental.index') }}" type="button" class="btn btn rounded-3">Data Rental</a>
<a href="{{ route('customer.index') }}" type="button" class="btn btn rounded-3">Data Customer</a>
<a href="{{ route('motor.index') }}" type="button" class="btn btn rounded-3">Data motor</a>
<a href="{{ route('sopir.index') }}" type="button" class="btn btn rounded-3">Data Sopir</a>
<a href="{{ route('home.index') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<h4 class="mt-5">Data Rental</h4>
<a href="{{ route('rental.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID Customer</th>
            <th>ID motor</th>
            <th>ID Sopir</th>
            <th>Harga</th>
            <th>Tanggal Rental</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_rental }}</td>
            <td>{{ $data->id_customer }}</td>
            <td>{{ $data->id_motor }}</td>
            <td>{{ $data->id_sopir }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->tgl_rental }}</td>
            <td>{{ $data->tgl_kembali }}</td>
            <td>
                <a href="{{ route('rental.edit', $data->id_rental) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->id_rental }}">
                    Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->id_rental }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('rental.delete', $data->id_rental) }}">
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