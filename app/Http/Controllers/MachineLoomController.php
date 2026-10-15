<?php

namespace App\Http\Controllers;

use App\Models\MachineLoom;
use Illuminate\Http\Request;

class MachineLoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['machine'] = MachineLoom::all();
        return view('machine.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('machine.create');
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
                'nama.required' => 'Nama Machine Loom Tidak Boleh Kosong!'
            ]
        );

        MachineLoom::create([
            'nama_machineloom' => $request->nama
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');
        return redirect()->route('machineloom');
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
        $data['machine'] = MachineLoom::find($id);
        return view('machine.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $machine = MachineLoom::find($id);
        $machine->update([
            'nama_machineloom' => $request->nama
        ]);

        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('machineloom');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $machine = MachineLoom::find($id);
        $machine->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('machineloom');
    }
}
