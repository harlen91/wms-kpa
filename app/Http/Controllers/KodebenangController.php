<?php

namespace App\Http\Controllers;

use App\Models\Kodebenang;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class KodebenangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kode'] = Kodebenang::all();
        return view('kodebenang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kodebenang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required'
            ],
            [
                'kode.required' => 'Kode Benang Tidak Boleh Kosong'
            ]
        );

        Kodebenang::create([
            'kode_benang' => $request->kode
        ]);

        $request->session()->flash('success', 'Berhasil disimpan!');
        return redirect()->route('kodebenang');
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
        $data['kode'] = Kodebenang::find($id);
        return view('kodebenang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kode = Kodebenang::find($id);
        $kode->update([
            'kode_benang' => $request->kode
        ]);
        $request->session()->flash('success', 'Berhasi diubah!');
        return redirect()->route('kodebenang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $kode = Kodebenang::find($id);
        $kode->delete();
        $request->session()->flash('success', 'Berhasi dihapus!');
        return redirect()->route('kodebenang');
    }
}
