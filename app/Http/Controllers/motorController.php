<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class motorController extends Controller
{
    public function search_trash(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $get_nama = $request->nama_motor;
        $datas = DB::table('motor')->where('deleted_at', '<>', '' )->where('nama_motor', 'LIKE', '%'.$get_nama.'%')->get();
        return view('motor.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        DB::update('UPDATE motor SET deleted_at=null WHERE id_motor = :id_motor', ['id_motor' => $id]);
        return redirect()->route('motor.trash');
    }
    public function trash()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from motor where deleted_at is not null');
        return view('motor.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        DB::update('UPDATE motor SET deleted_at=current_timestamp() WHERE id_motor = :id_motor', ['id_motor' => $id]);
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil dihapus');
    }
    public function search(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $get_nama = $request->nama_motor;
        $datas = DB::table('motor')->where('deleted_at', NULL )->where('nama_motor', 'LIKE', '%'.$get_nama.'%')->get();
        return view('motor.index')->with('datas', $datas);
    }
    public function delete($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM motor WHERE id_motor = :id_motor', ['id_motor' => $id]);
        return redirect()->route('motor.trash');
    }
    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $data = DB::table('motor')->where('id_motor', $id)->first();
        return view('motor.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $request->validate([
            'id_motor' => 'required',
            'nama_motor' => 'required',
            'tipe_motor' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE motor SET id_motor = :id_motor, nama_motor = :nama_motor, tipe_motor = :tipe_motor WHERE id_motor = :id',
            [
                'id' => $id,
                'id_motor' => $request->id_motor,
                'nama_motor' => $request->nama_motor,
                'tipe_motor' => $request->tipe_motor,
            ]
        );
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil diubah');
    }
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from motor where deleted_at is null');
        return view('motor.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        return view('motor.add');
    }
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $request->validate([
            'id_motor' => 'required',
            'nama_motor' => 'required',
            'tipe_motor' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO motor(id_motor, nama_motor, tipe_motor) VALUES (:id_motor, :nama_motor, :tipe_motor)',
            [
                'id_motor' => $request->id_motor,
                'nama_motor' => $request->nama_motor,
                'tipe_motor' => $request->tipe_motor,
            ]
        );
        return redirect()->route('motor.index')->with('success', 'Data motor berhasil disimpan');
    }
}