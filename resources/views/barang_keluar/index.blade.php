@extends('layouts.master1')
@section('main_content')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang Keluar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">1</a></li>
                            <li class="breadcrumb-item active">2</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- card data table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Data Barang Keluar</h3>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('barang_keluars.create') }}" class="btn btn-primary mb-4">Tambah</a>

                        {{-- pesan success input --}}
                        @if (session()->has('success'))
                            <div class='alert alert-success mb-4'>
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    {{-- <th>Id</th> --}}
                                    <th>Nama Customer</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Nomor Surat Jalan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($barang_keluars) > 0)
                                    @foreach ($barang_keluars as $item)
                                        <tr>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td>{{ $item->customer->nama_customer }}</td>
                                            <td>{{ $item->tgl_pengiriman }}</td>
                                            <td>{{ $item->no_surat_jalan }}</td>
                                            <td>


                                                {{-- Button Cetak --}}
                                                <a class="btn btn-warning mr-2"
                                                    href="{{ route('cetak', ['barang_keluar' => $item->id]) }}">Cetak</a>

                                                {{-- Button Detail --}}
                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('barang_keluars.show', ['barang_keluar' => $item->id]) }}">Detail</a>

                                                {{-- Button Hapus --}}
                                                <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"
                                                    data-toggle="modal" data-target="#modal-sm"
                                                    data-sup="{{ $item->customer->nama_customer }}">Delete</button>

                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><i>Belum ada data yang diinputkan</i></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

    </div>

    {{-- Modal Layout --}}
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST" id="formDelete" onsubmit="disableBtnSubmitDelForm()">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Peringatan !!!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mb-konfirmasi">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tidak</button>
                        <button id="btn-submit-delete" type="submit" class="btn btn-danger">Iya,
                            hapus!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id negara
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            $('#formDelete').attr('action', '/barang_keluars/' + id);

            let sup = $(this).attr('data-sup');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data dari : " + sup + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
