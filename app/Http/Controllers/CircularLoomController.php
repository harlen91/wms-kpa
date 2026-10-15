<?php

namespace App\Http\Controllers;

use App\Models\CircularLoom;
use Illuminate\Http\Request;

class CircularLoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['circular'] = CircularLoom::all();
        return view('circular.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('circular.create');
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

        CircularLoom::create([
            'nama_circular' => $request->nama,
            'nomor_circular' => $request->nomor,
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');

        return redirect()->route('circularloom');
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
        $data['circular'] = CircularLoom::find($id);

        return view('circular.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $circular = CircularLoom::find($id);
        $circular->update([
            'nama_circular' => $request->nama,
            'nomor_circular' => $request->nomor,
        ]);

        $request->session()->flash('success', 'Berhasi Diubah!');
        return redirect()->route('circularloom');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $circular = CircularLoom::find($id);
        $circular->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('circularloom');
    }
}
