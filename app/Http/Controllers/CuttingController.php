<?php

namespace App\Http\Controllers;

use App\Models\Cutting;
use Illuminate\Http\Request;

class CuttingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cutting'] = Cutting::all();
        return view('cutting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cutting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required',
        ], [
            'nama.required' => 'Lot Cutting Tidak Boleh Kosong!',
            'nomor.required' => 'Nomor Lot Cutting Tidak Boleh Kosong!'
        ]);

        Cutting::create([
            'nama_cutting' => $request->nama,
            'nomor_cutting' => $request->nomor
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('cutting');
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
        $data['cutting'] = Cutting::find($id);
        return view('cutting.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cutting = Cutting::find($id);
        $cutting->update([
            'nama_cutting' => $request->nama,
            'nomor_cutting' => $request->nomor
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('cutting');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $cutting = Cutting::find($id);
        $cutting->delete();
        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('cutting');
    }
}
