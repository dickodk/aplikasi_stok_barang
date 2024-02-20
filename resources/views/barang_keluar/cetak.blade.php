@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="content">

            {{-- <div class="card"> --}}
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>CV POLONIUM METALINDO</h1>
                    </div>

                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-6">No. Surat Jalan </dt>
                            <dd class="col-sm-6">{{ $barangKeluar->no_surat_jalan }}</dd>

                            <dt class="col-sm-6">Customer </dt>
                            <dd class="col-sm-6">{{ $barangKeluar->customer->nama_customer }}</dd>

                            <dt class="col-sm-6">Alamat </dt>
                            <dd class="col-sm-6">{{ $barangKeluar->customer->alamat }}</dd>

                            <dt class="col-sm-6">No. Telp </dt>
                            <dd class="col-sm-6">{{ $barangKeluar->customer->nomor_telepon }}</dd>

                            <dt class="col-sm-6">Tanggal Beli </dt>
                            <dd class="col-sm-6">{{ date('d/m/Y', strtotime($barangKeluar->tgl_beli)) }}</dd>

                            <dt class="col-sm-6">Tanggal Pengiriman </dt>
                            <dd class="col-sm-6">{{ date('d/m/Y', strtotime($barangKeluar->tgl_pengiriman)) }}</dd>
                        </dl>
                    </div>

                </div>
            </div>





            <div class="card-body">
                {{-- pesan success input --}}
                @if (session()->has('success'))
                    <div class='alert alert-success'>
                        {{ session()->get('success') }}
                    </div>
                @endif



                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Harga Jual Satuan</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; @endphp
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($detailBarangKeluar as $item)
                            @php $total +=  ($item->qty * $item->harga_jual); @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ number_format($item->qty, 0) }}</td>
                                <td>Rp {{ number_format($item->harga_jual, 0) }}</td>
                                <td>Rp {{ number_format($item->qty * $item->harga_jual, 0) }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                Jumlah
                            </td>
                            <td>
                                Rp {{ number_format($total, 0) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                Diskon ({{ number_format($barangKeluar->diskon, 0) }} %)
                            </td>
                            <td>
                                Rp {{ number_format(($barangKeluar->diskon / 100) * $total, 0) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                PPN 10%
                            </td>
                            <td>
                                Rp {{ number_format((10 / 100) * ($total - ($barangKeluar->diskon / 100) * $total)) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                Total Harga
                            </td>
                            <td>
                                Rp
                                {{ number_format($total - ($barangKeluar->diskon / 100) * $total + (10 / 100) * ($total - ($barangKeluar->diskon / 100) * $total)) }}

                            </td>
                        </tr>
                    </tfoot>
                </table>


                <div class="card-footer">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 text-right">
                                <dl class="row">
                                    <dt class="col-md-12">Palembang, {{ date('d/m/Y') }}</dt>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <dt>Hendra Setiawan</dt>
                            </div>

                        </div>
                    </div>

                </div>

                <button onclick="window.print();" class="btn btn-primary mt-2 no-print">
                    Print Me
                </button>
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
            $('#formDelete').attr('action', '/cetak_surat_jalan/' + id);

            let barang = $(this).attr('data-barang');
            $('#mb-konfirmasi').text("Apakah anda yakin ingin menghapus data : " + barang + " ?")
        })

        // jika tombol Ya, hapus ditekan, submit form hapus
        $('#formDelete [type="submit"]').click(function() {
            $('#formDelete').submit();
        })
    </script>
@endsection
