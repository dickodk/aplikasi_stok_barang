@extends('layouts.master1')

@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Edit</h1>
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
                    <form action="{{ route('detail_barang_masuks.update', $detail_barang_masuk->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            {{-- kolom barang --}}
                            <div class="col-lg-8">
                                <div class="form-group">
                                    @php
                                        if (old('nama_barang') !== null) {
                                            $option = old('nama_barang');
                                        } else {
                                            $option = $detail_barang_masuk->id_barang;
                                        }
                                    @endphp

                                    <label for="nama_barang">Nama Barang</label>
                                    <select name="nama_barang" required
                                        class="form-control @error('nama_barang') is-invalid @enderror">
                                        <option value="">--Pilih Barang--</option>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $option == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nama_barang')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- kolom qty --}}
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input min="0" class="form-control @error('jumlah') is-invalid @enderror"
                                        type="number" placeholder="Jumlah barang masuk" name="jumlah"
                                        value="{{ old('jumlah', $detail_barang_masuk->qty) }}" required maxlength="4"
                                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    @error('jumlah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            {{-- kolom Harga --}}
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input name="harga" min="3"
                                        class="form-control @error('harga') is-invalid @enderror" type="number"
                                        placeholder="Harga Satuan (Rp)"
                                        value="{{ old('harga', $detail_barang_masuk->harga_beli) }}" required maxlength="20"
                                        oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div style="display: none">
                            <div>Hidden Value</div>
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="">Hidden barang</label>
                                    <input type="text" class="form-control" name="hidden_barang"
                                        value="{{ $detail_barang_masuk->id_barang }}" readonly>
                                </div>

                                <div class="form-group col-lg-2">
                                    <div class="form-group">
                                        <label for="">Hidden jumlah</label>
                                        <input type="text" class="form-control" value="{{ $detail_barang_masuk->qty }}"
                                            name="hidden_jumlah" readonly>
                                    </div>
                                </div>

                                <div class="form-group col-lg-2">
                                    <div class="form-group">
                                        <label for="">Hidden harga</label>
                                        <input type="text" class="form-control"
                                            value="{{ $detail_barang_masuk->harga_beli }}" name="hidden_harga" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Perbarui</button>
                        </div>
                    </form>
                </div>

                {{-- <div class="card-footer">
                    Footer
                </div> --}}

            </div>

        </section>

    </div>
@endsection
