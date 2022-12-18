<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function rak()
    {
        return view('rak.rak', [
            'page' => 'rak.rak',
            'no' => 1,
            'raks' => Rak::all()
        ]);
    }

    public function rakAdd(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'baris' => 'required',
            'kolom' => 'required'
        ]);

        $rak = Rak::create([
            'kode' => $request->kode,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ]);

        $rak->save();

        return redirect('/rak')->with('success', 'Add success');
    }

    public function rakUpdate(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'baris' => 'required',
            'kolom' => 'required'
        ]);

        $rak = Rak::findOrFail($id);
        $rak->kode = $request->kode;
        $rak->baris = $request->baris;
        $rak->kolom = $request->kolom;
        $rak->save();

        return redirect('/rak')->with('success', 'Update success');
    }

    public function rakDelete($id)
    {
        Rak::findOrFail($id)->delete();

        return redirect('/rak')->with('success', 'Delete success');
    }
}