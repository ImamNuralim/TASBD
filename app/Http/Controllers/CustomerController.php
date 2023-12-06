<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function search_trash(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $get_nama = $request->nama;
        $datas = DB::table('customer')->where('deleted_at', '<>', '' )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('customer.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        DB::update('UPDATE customer SET deleted_at=null WHERE id_customer = :id_customer', ['id_customer' => $id]);
        return redirect()->route('customer.trash');
    }
    public function trash()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from customer where deleted_at is not null');
        return view('customer.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        DB::update('UPDATE customer SET deleted_at=current_timestamp() WHERE id_customer = :id_customer', ['id_customer' => $id]);
        return redirect()->route('customer.index')->with('success', 'Data Customer berhasil dihapus');
    }
    public function search(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $get_nama = $request->nama;
        $datas = DB::table('customer')->where('deleted_at', NULL )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('customer.index')->with('datas', $datas);
    }
    public function delete($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM customer WHERE id_customer = :id_customer', ['id_customer' => $id]);
        return redirect()->route('customer.index')->with('success', 'Data Customer berhasil dihapus');
    }
    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $data = DB::table('customer')->where('id_customer', $id)->first();
        return view('customer.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $request->validate([
            'id_customer' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE customer SET id_customer = :id_customer, nama = :nama, alamat = :alamat WHERE id_customer = :id',
            [
                'id' => $id,
                'id_customer' => $request->id_customer,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
            ]
        );
        return redirect()->route('customer.index')->with('success', 'Data Customer berhasil diubah');
    }
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::select('select * from customer where deleted_at is null');
        return view('customer.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        return view('customer.add');
    }
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $request->validate([
            'id_customer' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO customer(id_customer, nama, alamat) VALUES (:id_customer, :nama, :alamat)',
            [
                'id_customer' => $request->id_customer,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
            ]
        );
        return redirect()->route('customer.index')->with('success', 'Data Customer berhasil disimpan');
    }
}