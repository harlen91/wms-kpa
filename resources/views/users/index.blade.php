@extends('layout.dashboard')
@section('title', 'Manajemen User')
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
                    <div class="ibox-title">Data User</div>
                </div>
                <div class="ibox-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Shift</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->akses }}</td>
                                        <td>{{ $data->shift }}</td>
                                        <td>
                                            <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ route('users.edit', $data->id) }}" class="btn btn-outline-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary"><i class="fa fa-plus"></i>
                        Tambah Users</a>
                </div>
            </div>
        </div>
    </div>
@endsection
