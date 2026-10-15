<?php

namespace App\Http\Controllers;

use App\Models\Specroll;
use Illuminate\Http\Request;

class SpecrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['specroll'] = Specroll::all();
        return view('specroll.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('specroll.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required',
                'deskripsi' => 'required',
                'lebar' => 'required',
                'densitas' => 'required',
                'denier' => 'required',
                'standart' => 'required'
            ],
            [
                'kode.required' => 'Kode Roll Tidak Boleh Kosong!',
                'deskripsi.required' => 'Deskripsi Tidak Boleh Kosong!',
                'lebar.required' => 'Lebar Tidak Boleh Kosong!',
                'densitas.required' => 'Densitas Tidak Boleh Kosong!',
                'denier.required' => 'Denier Tidak Boleh Kosong!',
                'standart.required' => 'Standart Panjang Tidak Boleh Kosong!'
            ]
        );

        Specroll::create([
            'kode_roll' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'lebar' => $request->lebar,
            'densitas' => $request->densitas,
            'denier' => $request->denier,
            'standart_panjang' => $request->standart
        ]);

        $request->session()->flash('success', 'Berhasil Disimpan!');

        return redirect()->route('specroll');
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
        $data['specroll'] = Specroll::find($id);
        return view('specroll.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $spec = Specroll::find($id);
        $spec->update([
            'kode_roll' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'lebar' => $request->lebar,
            'densitas' => $request->densitas,
            'denier' => $request->denier,
            'standart_panjang' => $request->standart
        ]);

        $request->session()->flash('success', 'Berhasil Diubah!');
        return redirect()->route('specroll');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $specroll = Specroll::find($id);
        $specroll->delete();

        $request->session()->flash('success', 'Berhasil Dihapus!');

        return redirect()->route('specroll');
    }
}
