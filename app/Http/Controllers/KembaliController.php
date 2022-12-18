<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kembali;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KembaliController extends Controller
{
    public function kembali($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $kembali = Kembali::findOrFail($id);
        $kembali->status = 'selesai';
        $kembali->tanggal_kembali = date('y-m-d');

        $buku = Buku::findOrFail($pinjam->id_buku);
        $buku->stok = $buku->stok + 1;

        $kembali->save();
        $buku->save();
        $pinjam->delete();

        return redirect('/pinjam')->with('success', 'Buku dikambalikan');
    }

    public function riwayat()
    {
        $kembali = Kembali::latest()->get();
        if (Auth::user()->role == 'user') {
            $kembali = Kembali::all()->where('id_user', '==', Auth::user()->id);
        }
        return view('riwayat.riwayat', [
            'page' => 'riwayat.riwayat',
            'no' => 1,
            'riwayats' => $kembali,
        ]);
    }

    public function riwayatDelete($id)
    {
        Kembali::findOrFail($id)->delete();

        return redirect('/riwayat')->with('success', 'Delete success');
    }
}