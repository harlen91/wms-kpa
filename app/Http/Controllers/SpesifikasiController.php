<?php

namespace App\Http\Controllers;

use App\Models\Spesifikasi;
use Illuminate\Http\Request;

class SpesifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['spesifikasi'] = Spesifikasi::all();
        return view('spesifikasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spesifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required'
            ],
            [
                'nama.required' => 'Nama Spesifikasi Tidak Boleh Kosong!'
            ]
        );

        Spesifikasi::create([
            'nama_spesifikasi' => $request->nama,
        ]);

        $request->session()->flash('success', 'Berhasil disimpan!');
        return redirect()->route('spesifikasi');
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
        $data['spesifikasi'] = Spesifikasi::find($id);
        return view('spesifikasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $spesifikasi = Spesifikasi::find($id);
        $spesifikasi->update([
            'nama_spesifikasi' => $request->nama
        ]);
        $request->session()->flash('success', 'Berhasil diubah!');
        return redirect()->route('spesifikasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $spesifikasi = Spesifikasi::find($id);
        $spesifikasi->delete();
        $request->session()->flash('success', 'Berhasil dihapus!');
        return redirect()->route('spesifikasi');
    }
}
