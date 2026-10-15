@extends('layout.dashboard')
@section('title', 'Ubah User')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Ubah User</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('users.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Users</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama Petugas"
                                value="{{ $users->nama }}">
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username"
                                value="{{ $users->username }}">
                            @error('email')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password"
                                value="{{ @old('password') }}">
                            @error('password')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control">
                                <option value="{{ $users->akses }}">{{ $users->akses }}</option>
                                <option value="">--Pilih--</option>
                                <option value="supervisor">supervisor</option>
                                <option value="marketting">marketting</option>
                                <option value="admin">admin</option>
                                <option value="user benang">user benang</option>
                                <option value="user benang roll">user roll</option>
                                <option value="user fg">user fg</option>
                            </select>
                            @error('role')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Shift</label>
                            <select name="shift" class="form-control">
                                <option value="{{ $users->shift }}">{{ $users->shift }}</option>
                                <option value="">--Pilih--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            @error('shift')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
