<?php

namespace App\Http\Controllers;

use App\Models\DensitasProduk;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class DensitasProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['densitas'] = DensitasProduk::all();
        return view('densitas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('densitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Nama Densitas Produk'
        ]);

        DensitasProduk::create([
            'nama_densitasproduk' => $request->nama
        ]);
        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('densitas');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data['densitas'] = DensitasProduk::find($id);
        return view('densitas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $densitas = DensitasProduk::find($id);
        $densitas->update([
            'nama_densitasproduk' => $request->nama
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('densitas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, String $id)
    {
        $densitas = DensitasProduk::find($id);
        $densitas->delete();
        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('densitas');
    }
}
