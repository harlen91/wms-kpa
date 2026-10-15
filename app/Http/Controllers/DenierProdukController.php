<?php

namespace App\Http\Controllers;

use App\Models\DenierProduk;
use Illuminate\Http\Request;

class DenierProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['denier'] = DenierProduk::all();
        return view('denier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('denier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Denier Tidak Boleh Kosong!'
        ]);

        DenierProduk::create([
            'nama_denierproduk' => $request->nama
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('denier');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['denier'] = DenierProduk::find($id);
        return view('denier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $denier = DenierProduk::find($id);
        $denier->update([
            'nama_denierproduk' => $request->nama
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('denier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $denier = DenierProduk::find($id);
        $denier->delete();
        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('denier');
    }
}
