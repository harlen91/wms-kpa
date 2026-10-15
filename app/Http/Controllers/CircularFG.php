<?php

namespace App\Http\Controllers;

use App\Models\CircularLoomFg;
use Illuminate\Http\Request;

class CircularFG extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['circular'] = CircularLoomFg::all();
        return view('circularfg.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('circularfg.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'nomor' => 'required',
            ],
            [
                'nama.required' => 'Nama Circular Loom Tidak Boleh Kosong!',
                'nomor.required' => 'Nomor Circular Loom Tidak Boleh Kosong!'
            ]
        );

        CircularLoomFg::create([
            'nama_circular' => $request->nama,
            'nomor_circular' => $request->nomor,
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');

        return redirect()->route('circularloomfg');
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

        $data['circular'] = CircularLoomFg::find($id);

        return view('circularfg.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $circular = CircularLoomFg::find($id);
        $circular->update([
            'nama_circular' => $request->nama,
            'nomor_circular' => $request->nomor,
        ]);

        $request->session()->flash('success', 'Berhasi Diubah!');
        return redirect()->route('circularloomfg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $circular = CircularLoomFg::find($id);
        $circular->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('circularloomfg');
    }
}
