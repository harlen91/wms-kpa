<style>
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #a3ffc8;
    }
</style>
@extends('layout.dashboard')
@section('title', 'Retur Roll')
@section('content')
    {{-- @include('layout.card') --}}

    <?php
    $tanggal = date('Y/m/d');
    ?>
    @if (session()->has('error'))
        <script>
            swal({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            swal({
                title: "success!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Proses Retur Roll</div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('roll.pretur') }}" class="mb-5" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>ID Roll</label>
                            <input type="text" class="form-control" name="idroll" placeholder="ID Roll"
                                value="{{ @old('idroll') }}" autofocus>
                            @error('idroll')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"><i class="fa fa-arrow-left"></i> Proses</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
