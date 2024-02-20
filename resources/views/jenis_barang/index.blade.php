@extends('layouts.master1')

@section('main_content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Jenis Barang</h1>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- card data table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Jenis Barang</h3>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('jenis_barangs.create') }}" class="btn btn-primary mb-4">Tambah</a>

                        {{-- pesan success input --}}
                        @if (session()->has('success'))
                            <div class='alert alert-success mb-4'>
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('danger'))
                            <div class='alert alert-danger mb-4'>
                                {{ session()->get('danger') }}
                            </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Jenis Barang</th>
                                    @if (Auth::user()->role === 'owner')
                                        <th>Aksi</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($jenisBarangs) > 0)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($jenisBarangs as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->Jenis_barang }}</td>
                                            @if (Auth::user()->role === 'owner')
                                                <td>
                                                    @can('update', $item)
                                                        {{-- Button Ubah --}}

                                                        <a class="btn btn-warning mr-2"
                                                            href="{{ route('jenis_barangs.edit', ['jenis_barang' => $item->id]) }}">Ubah</a>
                                                    @endcan


                                                    @can('delete', $item)
                                                        {{-- Button Hapus --}}
                                                        <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"
                                                            data-toggle="modal" data-target="#modal-sm"
                                                            data-jenisBarang="{{ $item->Jenis_barang }}">Hapus</button>
                                                    @endcan

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"><i>Belum ada data yang diinputkan</i></td>
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
                        <button id="btn-submit-delete" type="submit" class="btn btn-danger">Iya, Hapus</button>
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
            $('#formDelete').attr('action', '/jenis_barangs/' + id);

            let jenisBarang = $(this).attr('data-jenisBarang');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + jenisBarang + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>

@endsection
