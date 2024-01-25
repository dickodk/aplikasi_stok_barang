@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Barang Keluar</h1>
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
                    <h3 class="card-title">Masukkan Data</h3>
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
                    {{-- form input data --}}

                    <form action="{{ route('barang_keluars.store') }}" method="POST">
                        @csrf
                        {{-- start row --}}
                        <div class="row">
                            {{-- kolom tanggal terima --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Beli</label>
                                    <input
                                        class="form-control @error('tgl_penerimaan') is-invalid
                                +@enderror"
                                        type="date" name="tgl_penerimaan" value="{{ old('tgl_penerimaan') }}" required>
                                    @error('tgl_penerimaan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            {{-- kolom tanggal kirim --}}
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Pengiriman</label>
                                    <input
                                        class="form-control @error('tgl_pengiriman') is-invalid
                                +@enderror"
                                        type="date" name="tgl_pengiriman" value="{{ old('tgl_pengiriman') }}" required>
                                    @error('tgl_pengiriman')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- kolom Nomor surat jalan --}}
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Nomor Surat Jalan</label>
                                    <input min="0"
                                        class="form-control @error('no_surat_jalan[]') is-invalid @enderror" type="text"
                                        placeholder="Jumlah barang keluar" name="no_surat_jalan"
                                        value="{{ old('no_surat_jalan') }}" required maxlength="20"
                                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    @error('no_surat_jalan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            {{-- kolom nama customer --}}
                            <div class="col-lg-8 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label>Nama Customer</label>
                                    <select class="form-control" fdprocessedid="4k1jpe" name="customers_id" required>
                                        <option value="">--Nama Customer--</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_customer }}</option>
                                        @endforeach
                                    </select>
                                    @error('customers_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- kolom Diskon --}}
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Diskon (%)</label>
                                    <input min="0" class="form-control @error('diskon[]') is-invalid @enderror"
                                        type="number" placeholder="Diskon" name="diskon" value="{{ old('diskon') }}"
                                        required maxlength="20"
                                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    @error('diskon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        {{-- end row --}}

                        <br>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Barang Keluar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm" id="dynamic-ar"
                                        title="Klik disini untuk menambahkan detailbarang">
                                        <i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div id="dynamicAddRemove" class="card-body">
                                {{-- start row --}}
                                <div class="row">
                                    {{-- kolom barang --}}
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <select name="nama_barang[]" required
                                                class="form-control @error('nama_barang[]') is-invalid @enderror">
                                                <option value="">--Pilih Barang--</option>
                                                @foreach ($barangs as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('nama_barang[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- kolom qty --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input min="0"
                                                class="form-control @error('jumlah[]') is-invalid @enderror"
                                                type="number" placeholder="Jumlab barang keluar" name="jumlah[]"
                                                value="{{ old('jumlah[]') }}" required maxlength="4"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('jumlah[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>


                                </div>
                                {{-- end row --}}
                            </div>


                        </div>

                        {{-- btn submit --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>

                    </form>
                </div>




                {{-- <div class="card-footer">
                Footer
            </div> --}}

            </div>

        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
                {{-- start row --}}
                                <div class="row">
                                    {{-- kolom barang --}}
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <select name="nama_barang[]" required
                                                class="form-control @error('nama_barang[]') is-invalid @enderror">
                                                <option value="">--Pilih Barang--</option>
                                                @foreach ($barangs as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('nama_barang[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- kolom qty --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input min="0"
                                                class="form-control @error('jumlah[]') is-invalid @enderror"
                                                type="number" placeholder="Jumlab barang keluar" name="jumlah[]"
                                                value="{{ old('jumlah[]') }}" required maxlength="4"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('jumlah[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>


                                </div>
                                {{-- end row --}}
            `);
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
