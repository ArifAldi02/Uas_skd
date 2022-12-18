<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori()
    {
        return view('kategori.kategori', [
            'page' => 'kategori.kategori',
            'no' => 1,
            'kategoris' => Kategori::all()
        ]);
    }

    public function kategoriAdd(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        $kategori = Kategori::create([
            'kategori' => $request->kategori
        ]);

        $kategori->save();

        return redirect('/kategori')->with('success', 'Add success');
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect('/kategori')->with('success', 'Update success');
    }

    public function kategoriDelete($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect('/kategori')->with('success', 'Delete success');
    }
}