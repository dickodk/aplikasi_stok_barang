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
                    <form action="{{ route('barang_keluars.update', $barangKeluar->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="">Tanggal Pengiriman</label>
                            <input
                                class="form-control @error('tgl_pengiriman') is-invalid
                                @enderror"
                                type="date" name="tgl_pengiriman" id=""
                                value="{{ old('tgl_pengiriman', $barangKeluar->tgl_pengiriman) }}" required>
                            @error('tgl_pengiriman')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>id Customer</label>
                            <select class="custom-select  @error('id_customers') is-invalid @enderror"
                                fdprocessedid="4k1jpe" name="id_customers" required>
                                <option value="">--Nama Supplier--</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_customers') == $item->id ? 'selected' : $barangKeluar->id_supplier == $item->id) ? 'selected' : null }}>
                                        {{ $item->nama_supplier }}</option>
                                @endforeach
                            </select>
                            @error('id_customers')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="">qty</label>
                            <input class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty" name="qty" value="{{ old('qty', $barangKeluar->qty) }}"
                                required>
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>


                <div class="form-group">
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
                </form>
            </div>


    </div>

    </section>

    </div>
@endsection
