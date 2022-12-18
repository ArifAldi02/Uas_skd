<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function buku()
    {
        return view('buku.buku', [
            'page' => 'buku.buku',
            'no' => 1,
            'bukus' => Buku::latest()->get(),
            'kategoris' => Kategori::all(),
            'raks' => Rak::all(),
        ]);
    }

    public function bukuDetail($id)
    {
        return view('buku.bukuDetail', [
            'page' => 'buku.bukuDetail',
            'buku' => Buku::findOrFail($id),
            'kategoris' => Kategori::all(),
            'raks' => Rak::all(),
        ]);
    }

    public function bukuAdd(Request $request)
    {
        $request->validate([
            'id_rak' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required',
            'cover' => 'required|image',
            'kode' => 'required',
            'penerbit' => 'required',
            'sinopsis' => 'required',
            'stok' => 'required',
        ]);


        $buku = Buku::create([
            'id_rak' => $request->id_rak,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'cover' => $request->cover,
            'kode' => $request->kode,
            'penerbit' => $request->penerbit,
            'sinopsis' => $request->sinopsis,
            'stok' => $request->stok,
        ]);

        if ($request->hasFile('cover')) {
            $request->file('cover')->move('img/', $request->file('cover')->getClientOriginalName());
            $buku->cover = $request->file('cover')->getClientOriginalName();
            $buku->save();
        }

        return redirect('/buku')->with('success', 'Add success');
    }

    public function bukuUpdateCover(Request $request, $id)
    {
        $request->validate([
            'cover' => 'required',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->cover = $request->cover;

        if ($request->hasFile('cover')) {
            $request->file('cover')->move('img/', $request->file('cover')->getClientOriginalName());
            $buku->cover = $request->file('cover')->getClientOriginalName();
            $buku->save();
        }

        return redirect('/buku/detail/' . $id)->with('success', 'Update success');
    }

    public function bukuUpdateDetail(Request $request, $id)
    {
        $request->validate([
            'id_rak' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required',
            'kode' => 'required',
            'penerbit' => 'required',
            'sinopsis' => 'required',
            'stok' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        $buku->id_rak = $request->id_rak;
        $buku->id_kategori = $request->id_kategori;
        $buku->judul = $request->judul;
        $buku->kode = $request->kode;
        $buku->penerbit = $request->penerbit;
        $buku->sinopsis = $request->sinopsis;
        $buku->stok = $request->stok;

        $buku->save();

        return redirect('/buku/detail/' . $id)->with('success', 'Update success');
    }

    public function bukuDelete($id)
    {
        Buku::findOrFail($id)->delete();

        return redirect('/buku')->with('success', 'Delete success');
    }
}