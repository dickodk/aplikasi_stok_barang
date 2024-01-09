@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Barang Keluar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tanggal Beli: {{ $barangMasuk->tgl_penerimaan }}; Customer:
                        {{ $barangKeluar->customer->nama_customer }}; Tanggal Pengiriman:
                        {{ $barangKeluar->tgl_pengiriman }}: No. Surat Jalan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{-- pesan success input --}}
                    @if (session()->has('success'))
                        <div class='alert alert-success'>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <a class="btn btn-primary mb-3"
                        href="{{ route('detail_barang_keluars.create', ['barang_keluar' => $barangKeluar->id]) }}">Tambahkan
                        barang</a>

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Keluar</th>
                                <th>Harga Jual Satuan</th>
                                <th>Total Harga</th>
                                {{-- <th>Diskon</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($detailBarangKeluar as $item)
                                <tr>
                                    <td>{{ $item->barangs->nama_barang }}</td>
                                    <td>{{ number_format($item->qty, 0) }}</td>
                                    <td>Rp {{ number_format($item->harga_jual, 0) }}</td>
                                    <td>Rp {{ number_formar($item->qty * $item->harga_jual, 0) }}</td>
                                    {{-- <td>{{ number_format($item->harga_jual, 0) }} %</td> --}}
                                    <td>
                                        {{-- Button Detaol --}}

                                        <a class="btn btn-warning mr-2"
                                            href="{{ route('detail_barang_keluars.edit', ['detail_barang_keluar' => $item->id]) }}">Edit</a>

                                        {{-- Button Hapus --}}
                                        <button class="btn btn-danger btn-hapus" data-id="{{ $item->id }}"
                                            data-toggle="modal" data-target="#modal-sm"
                                            data-barang="{{ $item->barangs->nama_barang }}">Delete</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    </section>

    </div>

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
            $('#formDelete').attr('action', '/detail_barang_keluars/' + id);

            let barang = $(this).attr('data-barang');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + barang + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>
@endsection
