<?php

namespace App\Http\Controllers;

use App\Models\Lotextruder;
use Illuminate\Http\Request;

class LotextruderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['lotextruder'] = Lotextruder::all();
        return view('lotextruder.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lotextruder.create');
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
                'jenis' => 'required'
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nomor.required' => 'Nomor Tidak Boleh Kosong',
                'jenis.required' => 'Jenis Tidak Boleh Kosong'
            ]
        );

        Lotextruder::create([
            'nama_lotextruder' => $request->nama,
            'nomor_lotextruder' => $request->nomor,
            'jenis' => $request->jenis
        ]);

        $request->session()->flash('success', 'Berhasil disimpan!');
        return redirect()->route('lotextruder');
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
        $data['lotextruder'] = Lotextruder::find($id);
        return view('lotextruder.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $x = Lotextruder::find($id);
        $x->update([
            'nama_lotextruder' => $request->nama,
            'nomor_lotextruder' => $request->nomor,
            'jenis' => $request->jenis
        ]);

        $request->session()->flash('success', 'Berhasil disimpan!');
        return redirect()->route('lotextruder');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $x = Lotextruder::find($id);
        $x->delete();

        $request->session()->flash('success', 'Berhasil dihapus!');
        return redirect()->route('lotextruder');
    }
}
