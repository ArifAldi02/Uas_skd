<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kembali;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{

    public function pinjam()
    {
        $pinjam = Pinjam::all()->where('status', '==', 'pinjam');
        $pending = Pinjam::all()->where('status', '==', 'pending');
        if (Auth::user()->role == 'user') {
            $pinjam = Pinjam::all()->where('id_user', '==', Auth::user()->id)->where('status', '==', 'pinjam');
            $pending = Pinjam::all()->where('id_user', '==', Auth::user()->id)->where('status', '==', 'pending');
        }
        return view('pinjam.pinjam', [
            'page' => 'pinjam.pinjam',
            'no' => 1,
            'pinjams' => $pinjam,
            'pendings' => $pending,
        ]);
    }

    public function pinjamRequest()
    {
        return view('pinjam.request', [
            'page' => 'pinjam.request',
            'no' => 1,
            'pinjams' => Pinjam::all()->where('status', '==', 'pending'),
        ]);
    }

    public function pinjamAdmin(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
            'batas_pinjam' => 'required',
        ]);

        $pinjam = Pinjam::create([
            'id_user' => $request->id_user,
            'id_buku' => $id,
            'tanggal_pinjam' => date('y-m-d'),
            'batas_pinjam' => $request->batas_pinjam,
            'status' => 'pinjam',
        ]);
        $pinjam->save();

        $kembali = Kembali::create([
            'id_user' => $request->id_user,
            'id_buku' => $id,
            'status' => 'pinjam',
        ]);
        $kembali->save();

        $buku = Buku::findOrFail($id);
        $buku->stok = $buku->stok - 1;
        $buku->save();

        return redirect('/buku/detail/' . $id)->with('success', 'Pinjam success');
    }

    public function pinjamUser(Request $request, $id)
    {
        $request->validate([
            'batas_pinjam' => 'required',
        ]);

        $pinjam = Pinjam::create([
            'id_user' => Auth::user()->id,
            'id_buku' => $id,
            'tanggal_pinjam' => date('y-m-d'),
            'batas_pinjam' => $request->batas_pinjam,
            'status' => 'pending',
        ]);
        $pinjam->save();

        $kembali = Kembali::create([
            'id_user' => Auth::user()->id,
            'id_buku' => $id,
            'status' => 'pending'
        ]);
        $kembali->save();

        $buku = Buku::findOrFail($id);
        $buku->stok = $buku->stok - 1;
        $buku->save();

        return redirect('/buku/detail/' . $id)->with('success', 'Pinjam success');
    }

    public function pinjamRequestTerima($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->status = 'pinjam';

        $kembali = Kembali::findOrFail($id);
        $kembali->status = 'pinjam';

        $pinjam->save();
        $kembali->save();

        return redirect('/pinjam/request')->with('success', 'Permintaan diterima');
    }

    public function pinjamRequestTolak($id)
    {
        $buku = Buku::findOrFail(Pinjam::findOrFail($id)->id_buku);
        $buku->stok = $buku->stok + 1;
        $buku->save();

        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();

        $kembali = Kembali::findOrFail($id);
        $kembali->status = 'tolak';
        $kembali->save();

        if (Auth::user()->role == 'user') {
            return redirect('/pinjam')->with('success', 'Batal success');
        }
        return redirect('/pinjam/request')->with('success', 'Permintaan ditolak');
    }
}