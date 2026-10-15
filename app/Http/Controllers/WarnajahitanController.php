<?php

namespace App\Http\Controllers;

use App\Models\WarnaJahitan;
use Illuminate\Http\Request;

class WarnajahitanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['warna'] = WarnaJahitan::all();
        return view('warna.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ], [
            'nama.required' => 'Warna Jahita Tidak Boleh Kosong!'
        ]);

        WarnaJahitan::create([
            'nama_warna' => $request->nama
        ]);
        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('warna');
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
        $data['warna'] = WarnaJahitan::find($id);
        return view('warna.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warna = WarnaJahitan::find($id);

        $warna->update([
            'nama_warna' => $request->nama
        ]);

        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('warna');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $warna = WarnaJahitan::find($id);
        $warna->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('warna');
    }
}
