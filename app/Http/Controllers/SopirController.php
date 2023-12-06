<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SopirController extends Controller
{
    public function search_trash(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $get_nama = $request->nama_sopir;
        $datas = DB::table('sopir')->where('deleted_at', '<>', '' )->where('nama_sopir', 'LIKE', '%'.$get_nama.'%')->get();
        return view('sopir.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        DB::update('UPDATE sopir SET deleted_at=null WHERE id_sopir = :id_sopir', ['id_sopir' => $id]);
        return redirect()->route('sopir.trash');
    }
    public function trash()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from sopir where deleted_at is not null');
        return view('sopir.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        
        DB::update('UPDATE sopir SET deleted_at=current_timestamp() WHERE id_sopir = :id_sopir', ['id_sopir' => $id]);
        return redirect()->route('sopir.index')->with('success', 'Data Sopir berhasil dihapus');
    }
    public function search(Request $request)
    {if (!auth()->check()) {
        return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
    }
        $get_nama = $request->nama_sopir;
        $datas = DB::table('sopir')->where('deleted_at', NULL )->where('nama_sopir', 'LIKE', '%'.$get_nama.'%')->get();
        return view('sopir.index')->with('datas', $datas);
    }   
    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM sopir WHERE id_sopir = :id_sopir', ['id_sopir' => $id]);
        return redirect()->route('sopir.trash');
    }
    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $data = DB::table('sopir')->where('id_sopir', $id)->first();
        return view('sopir.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $request->validate([
            'id_sopir' => 'required',
            'nama_sopir' => 'required',
            'alamat_sopir' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE sopir SET id_sopir = :id_sopir, nama_sopir = :nama_sopir, alamat_sopir = :alamat_sopir WHERE id_sopir = :id',
            [
                'id' => $id,
                'id_sopir' => $request->id_sopir,
                'nama_sopir' => $request->nama_sopir,
                'alamat_sopir' => $request->alamat_sopir,
            ]
        );
        return redirect()->route('sopir.index')->with('success', 'Data Sopir berhasil diubah');
    }
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from sopir where deleted_at is null');
        return view('sopir.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        return view('sopir.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_sopir' => 'required',
            'nama_sopir' => 'required',
            'alamat_sopir' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO sopir(id_sopir, nama_sopir, alamat_sopir) VALUES (:id_sopir, :nama_sopir, :alamat_sopir)',
            [
                'id_sopir' => $request->id_sopir,
                'nama_sopir' => $request->nama_sopir,
                'alamat_sopir' => $request->alamat_sopir,
            ]
        );
        return redirect()->route('sopir.index')->with('success', 'Data Sopir berhasil disimpan');
    }
}