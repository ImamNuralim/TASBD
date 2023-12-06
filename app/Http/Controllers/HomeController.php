<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.create'); // Redirect ke halaman login jika pengguna belum login
        }
        $datas = DB::table('rental')
                ->join('customer', 'customer.id_customer', '=', 'rental.id_customer')
                ->join('motor', 'motor.id_motor', '=', 'rental.id_motor')
                ->join('sopir', 'sopir.id_sopir', '=', 'rental.id_sopir')
                ->get();

        return view('home.index')
            ->with('datas', $datas);
    }
}