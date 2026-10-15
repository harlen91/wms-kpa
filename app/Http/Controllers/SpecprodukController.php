<?php

namespace App\Http\Controllers;

use App\Models\specproduk;
use App\Models\Specroll;
use Illuminate\Http\Request;

class SpecprodukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['spek'] = specproduk::all();
        return view('specproduk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specproduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'denier' => 'required',
            'densitas' => 'required',
            'jumlah' => 'required'
        ], [
            'nama.required' => 'Nama Spek Produk Tidak Boleh Kosong!',
            'panjang.required' => 'Panjang Tidak Boleh Kosong!',
            'lebar.required' => 'Lebar Tidak Boleh Kosong!',
            'denier.required' => 'Denier Tidak Boleh Kosong!',
            'densitas.required' => 'Densitas Tidak Boleh Kosong!',
            'jumlah.required' => 'Jumlah Lembar Tidak Boleh Kosong!'
        ]);
        specproduk::create([
            'nama_specproduk' => $request->nama,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'jumlah_lembar' => $request->jumlah
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('specproduk');
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
        $data['spek'] = specproduk::find($id);
        return view('specproduk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $spek = specproduk::find($id);
        $spek->update([
            'nama_specproduk' => $request->nama,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'denier' => $request->denier,
            'densitas' => $request->densitas,
            'jumlah_lembar' => $request->jumlah
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('specproduk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $spek = specproduk::find($id);
        $spek->delete();
        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('specproduk');
    }
}
