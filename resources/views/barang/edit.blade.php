@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Ubah</h1>
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
                    <form action="{{ route('barangs.update', $barang->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">

                            <label for="">Nama Produk</label>
                            <input
                                class="form-control @error('nama_barang') is-invalid
                            @enderror"
                                type="text" name="nama_barang" id=""
                                placeholder="Nama Barang; Maximal 30 karakter"
                                value="{{ old('nama_barang', $barang->nama_barang) }}" required maxlength="30">

                            @error('nama_barang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty; Maximal 255 angka" name="qty"
                                value="{{ old('qty', $barang->qty) }}" required maxlength="255"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="harga_jual">Harga</label>
                            <input class="form-control @error('harga_jual') is-invalid @enderror" type="text"
                                placeholder="Harga_jual" name="harga_jual"
                                value="{{ old('harga_jual', $barang->harga_jual) }}" required
                                oninput="updateCurrency(this)">
                            @error('harga_jual')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror



                        </div>


                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <select class="custom-select  @error('jenis_barangs_id') is-invalid @enderror"
                                fdprocessedid="4k1jpe" name="jenis_barangs_id" required>
                                <option value="">--Silahkan Pilih Jenis Barang--</option>
                                @foreach ($jenisBarang as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('jenis_barangs_id') == $item->id ? 'selected' : $barang->jenis_barangs_id == $item->id) ? 'selected' : null }}>
                                        {{ $item->Jenis_barang }}</option>
                                @endforeach
                            </select>
                            @error('jenis_barangs_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Perbarui</button>
                        </div>


                </div>
                </form>
            </div>
    </div>
    </section>
    </div>
@endsection
