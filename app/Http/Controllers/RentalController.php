<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RentalController extends Controller
{
    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM rental WHERE id_rental = :id_rental', ['id_rental' => $id]);
        return redirect()->route('rental.index')->with('success', 'Data Rental berhasil dihapus');
    }
    public function edit($id)
    {
        $data = DB::table('rental')->where('id_rental', $id)->first();
        return view('rental.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'id_rental' => 'required',
            'id_customer' => 'required',
            'id_motor' => 'required',
            'id_sopir' => 'required',
            'harga' => 'required',
            'tgl_rental' => 'required',
            'tgl_kembali' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE rental SET id_rental = :id_rental, id_customer = :id_customer, id_motor = :id_motor, id_sopir = :id_sopir, harga = :harga, tgl_rental = :tgl_rental, tgl_kembali = :tgl_kembali WHERE id_rental = :id',
            [
                'id' => $id,
                'id_rental' => $request->id_rental,
                'id_customer' => $request->id_customer,
                'id_motor' => $request->id_motor,
                'id_sopir' => $request->id_sopir,
                'harga' => $request->harga,
                'tgl_rental' => $request->tgl_rental,
                'tgl_kembali' => $request->tgl_kembali,
            ]
        );
        return redirect()->route('rental.index')->with('success', 'Data Rental berhasil diubah');
    }
    public function index()
    {   
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        
        $datas = DB::select('select * from rental');
        return view('rental.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        return view('rental.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_rental' => 'required',
            'id_customer' => 'required',
            'id_motor' => 'required',
            'id_sopir' => 'required',
            'harga' => 'required',
            'tgl_rental' => 'required',
            'tgl_kembali' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO rental(id_rental, id_customer, id_motor, id_sopir, harga, tgl_rental, tgl_kembali) VALUES (:id_rental, :id_customer, :id_motor, :id_sopir, :harga, :tgl_rental, :tgl_kembali)',
            [
                'id_rental' => $request->id_rental,
                'id_customer' => $request->id_customer,
                'id_motor' => $request->id_motor,
                'id_sopir' => $request->id_sopir,
                'harga' => $request->harga,
                'tgl_rental' => $request->tgl_rental,
                'tgl_kembali' => $request->tgl_kembali,
            ]
        );
        return redirect()->route('rental.index')->with('success', 'Data Rental berhasil disimpan');
    }
}