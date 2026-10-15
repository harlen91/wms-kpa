<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ViewErrorBag;
use PhpParser\Node\Expr\Cast\String_;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::all();
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'username' => 'required',
                'password' => 'required',
                'role' => 'required',
                'shift' => 'required'
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong!',
                'username.required' => 'Username Tidak Boleh Kosong!',
                'password.required' => 'Password Tidak Boleh Kosong!',
                'role.required' => 'Role Tidak Boleh Kosong!',
                'shift.required' => 'Shift Tidak Boleh Kosong!'
            ]
        );

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'akses' => $request->role,
            'shift' => $request->shift
        ]);

        $request->session()->flash('success', 'Berhasil disimpan!');
        return redirect()->route('users');
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
        $data['users'] = User::find($id);
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $pass = $request->password;
        // echo $request->role;
        if (empty($pass)) {
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'shift' => $request->shift,
                'akses' => $request->role
            ]);
        } else {
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'shift' => $request->shift,
                'akses' => $request->role
            ]);
        }

        $request->session()->flash('success', 'Berhasil diubah!');
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::find($id);
        $user->delete();

        $request->session()->flash('success', 'Berhasil dihapus!');
        return redirect()->route('users');
    }
    public function profil()
    {
        $data['user'] = User::find(auth()->user()->id);
        return view('users.profil', $data);
    }
    public function ubah(Request $request, String $id)
    {
        // dd($request->password . " " . $id);
        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $request->session()->flash('success', 'Berhasil diubah!');
        return redirect()->route('users.profil');
    }
}
