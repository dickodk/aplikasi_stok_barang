@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Create</h1>
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
                    <form action="{{ route('barangs.store') }}" method="POST">
                        @csrf
                        <div class="form-group">

                            <label for="">Nama Barang</label>
                            <input
                                class="form-control @error('nama_barang') is-invalid
                            @enderror"
                                type="text" name="nama_barang" id=""
                                placeholder="Nama Barang; Maximal 30 karakter" value="{{ old('nama_barang') }}" required
                                maxlength="30">

                            @error('nama_barang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="">qty</label>
                            <input min="0"
                                class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty" name="qty" value="{{ old('qty') }}" required
                                maxlength="20"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga_jual">Harga</label>
                            <input min="0" class="form-control @error('harga_jual') is-invalid @enderror"
                                type="number" placeholder="Harga_jual" name="harga_jual" required
                                oninput="updateCurrency(this)">
                            @error('harga_jual')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <script>
                                function updateCurrency(input) {
                                    // Hapus karakter non-numeric
                                    let value = input.value.replace(/\D/g, '');

                                    // Format nilai sebagai mata uang
                                    value = new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                    }).format(value);

                                    // Perbarui nilai input dengan nilai yang diformat
                                    input.value = value;
                                }
                            </script>

                            {{-- <script>
                                function updateCurrency(input) {
                                    // Mengambil nilai input
                                    var inputValue = input.value;

                                    // Menghapus karakter selain digit dan desimal point dari input
                                    var rawValue = inputValue.replace(/[^\d.]/g, '');

                                    // Mengonversi nilai ke tipe numerik
                                    var numericValue = parseFloat(rawValue);

                                    // Memastikan nilai numerik valid sebelum diformat
                                    if (!isNaN(numericValue)) {
                                        // Mengonversi nilai ke dalam format mata uang yang diinginkan tanpa simbol mata uang dan desimal
                                        var formattedValue = new Intl.NumberFormat('id-ID', {
                                            maximumFractionDigits: 0
                                        }).format(numericValue);

                                        // Mengganti nilai input dengan format tanpa simbol mata uang dan desimal
                                        input.value = formattedValue;
                                    } else {
                                        // Jika nilai tidak valid, kosongkan input
                                        input.value = '';
                                    }
                                }
                            </script> --}}


                        </div>


                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <select
                                class="custom-select  @error('jenis_barangs_id') is-invalid
                            @enderror"
                                fdprocessedid="4k1jpe" name="jenis_barangs_id" required>
                                <option value="">--Silahkan Pilih Jenis Barang--</option>
                                @foreach ($jenisBarangs as $item)
                                    <option value="{{ $item->id }}">{{ $item->Jenis_barang }}</option>
                                @endforeach
                            </select>
                            @error('jenis_barangs_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>


                </div>
                </form>
            </div>
    </div>
    </section>
    </div>
@endsection
