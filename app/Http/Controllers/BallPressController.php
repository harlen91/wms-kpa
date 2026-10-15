<?php

namespace App\Http\Controllers;

use App\Models\BallPress;
use Illuminate\Http\Request;

class BallPressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['ballpress'] = BallPress::all();
        return view('ballpress.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ballpress.create');
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
                'nama.required' => 'Ball Press Tidak Boleh Kosong!',
                'nomor.required' => 'Nomor Ball Press Tidak Boleh Kosong!'
            ]
        );
        BallPress::create([
            'nama_ballpress' => $request->nama,
            'nomor_ballpress' => $request->nomor
        ]);
        $request->session()->flash('success', 'Berhasil Dihapus');

        return redirect()->route('ballpress');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['ballpress'] = BallPress::find($id);
        return view('ballpress.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ballpress = BallPress::find($id);
        $ballpress->update([
            'nama_ballpress' => $request->nama,
            'nomor_ballpress' => $request->nomor
        ]);
        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('ballpress');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $ballpress = BallPress::find($id);
        $ballpress->delete();
        $request->session()->flash('success', 'Berhasil Dihapus!');
        return redirect()->route('ballpress');
    }
}
