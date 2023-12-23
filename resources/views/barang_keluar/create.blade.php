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
                    <form action="{{ route('barang_keluars.store') }}" method="POST">
                        @csrf



                        <div class="form-group">
                            <label>id Customer</label>
                            <select
                                class="custom-select  @error('id_customer') is-invalid
                            @enderror"
                                fdprocessedid="4k1jpe" name="id_customer" required>
                                <option value="">--Silahkan Pilih Customer--</option>
                                @foreach ($customers as $item)
                                    <option value="{{ $item->id }}">{{ $item->id_customer }}</option>
                                @endforeach
                            </select>
                            @error('id_customer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Tanggal Kirim</label>
                                <input
                                    class="form-control @error('tgl_pengiriman') is-invalid
                                +@enderror"
                                    type="date" name="tgl_pengiriman" value="{{ old('tgl_pengiriman') }}" required>
                                @error('tgl_pengiriman')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="">qty</label>
                            <input class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty" name="qty" value="{{ old('qty') }}" required
                                maxlength="20"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Diskon</label>
                            <input class="form-control @error('diskon') is-invalid
                            @enderror"
                                type="number" placeholder="diskon" name="diskon" value="{{ old('diskon') }}" required
                                maxlength="20"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            @error('diskon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="">Nomor Surat Jalan</label>
                            <input
                                class="form-control @error('no_surat_jalan') is-invalid
                            @enderror"
                                type="number" placeholder="Nomor Surat Jalan; Maximal 13 angka" name="no_surat_jalan"
                                value="{{ old('no_surat_jalan') }}" required maxlength="13"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                            @error('no_surat_jalan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                    </form>

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
