@extends('layouts.master1')

@section('main_content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Supplier</h1>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- card data table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Data Supplier</h3>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-4">Tambah</a>

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
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($suppliers) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($suppliers as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td>{{ $item->nama_supplier }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->nomor_telepon }}</td>
                                            <td>
                                                {{-- Button Ubah --}}

                                                <a class="btn btn-warning mr-2"
                                                    href="{{ route('suppliers.edit', ['supplier' => $item->id]) }}">Ubah</a>

                                                {{-- Button Hapus --}}
                                                <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"
                                                    data-toggle="modal" data-target="#modal-sm"
                                                    data-supplier="{{ $item->nama_supplier }}">Hapus</button>

                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><i>Belum ada data yang diinputkan</i></td>
                                    </tr>
                                @endif
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Jenis Barang</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
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
                        <button id="btn-submit-delete" type="submit" class="btn btn-danger">Iya, hapus!</button>
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
            $('#formDelete').attr('action', '/suppliers/' + id);

            let supplier = $(this).attr('data-supplier');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + supplier + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
