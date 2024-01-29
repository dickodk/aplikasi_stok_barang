@extends('layouts.master1')
@section('main_content')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang Masuk</h1>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- card data table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Data Barang Masuk</h3>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('barang_masuks.create') }}" class="btn btn-primary mb-4">Tambah</a>

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
                                    <th>No. </th>
                                    <th>Nama Supplier</th>
                                    <th>Tanggal Terima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($barang_masuks) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($barang_masuks as $item)
                                        {{-- @dd($item) --}}

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td>{{ $item->supplier->nama_supplier }}</td>
                                            <td>{{ $item->tgl_penerimaan }}</td>
                                            <td>
                                                {{-- Button Detail --}}

                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('barang_masuks.show', ['barang_masuk' => $item->id]) }}">Detail</a>

                                                @can('delete', $item)
                                                    {{-- Button Hapus --}}
                                                    <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"
                                                        data-toggle="modal" data-target="#modal-sm"
                                                        data-sup="{{ $item->supplier->nama_supplier }}">Hapus</button>
                                                @endcan

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
            $('#formDelete').attr('action', '/barang_masuks/' + id);

            let sup = $(this).attr('data-sup');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data dari : " + sup + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
