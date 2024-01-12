@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Barang Masuk</h1>
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

                    <form action="{{ route('barang_masuks.store') }}" method="POST">
                        @csrf
                        {{-- start row --}}
                        <div class="row">
                            {{-- kolom tanggal terima --}}
                            <div class="col-lg-2 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Terima</label>
                                    <input
                                        class="form-control @error('tgl_penerimaan') is-invalid
                                +@enderror"
                                        type="date" name="tgl_penerimaan" value="{{ old('tgl_penerimaan') }}" required>
                                    @error('tgl_penerimaan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- kolom nama supplier --}}
                            <div class="col-lg-10 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="id_supplier">Nama Supplier</label>
                                    <select class="form-control js-example-basic-single" fdprocessedid="4k1jpe"
                                        name="id_supplier" required>
                                        <option value="">--Nama Supplier--</option>
                                        @foreach ($suppliers as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_supplier')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                        </div>
                        {{-- end row --}}



                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Barang</h3>
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input min="0"
                                                class="form-control @error('jumlah[]') is-invalid @enderror" type="number"
                                                placeholder="Jumlab barang masuk" name="jumlah[]"
                                                value="{{ old('jumlah[]') }}" required maxlength="4"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('jumlah[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- kolom Harga --}}
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input name="harga[]" min="3"
                                                class="form-control @error('harga[]') is-invalid @enderror" type="number"
                                                placeholder="Harga Satuan (Rp)" value="{{ old('harga[]') }}" required
                                                maxlength="20"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('harga[]')
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


    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input min="0"
                                                class="form-control @error('jumlah[]') is-invalid @enderror" type="number"
                                                placeholder="Jumlab barang masuk" name="jumlah[]"
                                                value="{{ old('jumlah[]') }}" required maxlength="4"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('jumlah[]')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- kolom Harga --}}
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input name="harga[]" min="3"
                                                class="form-control @error('harga[]') is-invalid @enderror" type="number"
                                                placeholder="Harga Satuan (Rp)" value="{{ old('harga[]') }}" required
                                                maxlength="20"
                                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                            @error('harga[]')
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
