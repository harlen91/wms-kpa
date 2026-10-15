@extends('layout.dashboard')
@section('title', 'Profil User')
@section('content')
    {{-- @include('layout.card') --}}
    <div class="row">
        @if (session()->has('success'))
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            </script>
        @endif
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Profil User</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('users.ubah', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Users</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama User"
                                value="{{ $user->nama }}" readonly>
                            @error('nama')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Username"
                                value="{{ $user->username }}" readonly>
                            @error('email')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input class="form-control" type="text" name="role" placeholder="Username"
                                value="{{ $user->role }}" readonly>
                            @error('role')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Shift</label>
                            <input class="form-control" type="text" name="shift" placeholder="Username"
                                value="{{ $user->shift }}" readonly>
                            @error('shift')
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
                            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
