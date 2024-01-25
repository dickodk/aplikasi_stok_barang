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
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">

                            <label for="">Nama</label>
                            <input
                                class="form-control @error('nama_customer') is-invalid
                            @enderror"
                                type="text" name="nama_customer" id=""
                                placeholder="Nama Customer; Maximal 50 karakter" value="{{ old('nama_customer') }}" required
                                maxlength="50">

                            @error('nama_customer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid
                            @enderror"
                                type="text" name="alamat" id="" placeholder="Alamat; Maximal 200 karakter"
                                value="{{ old('alamat') }}" required maxlength="200">
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input
                                class="form-control @error('nomor_telepon') is-invalid
                            @enderror"
                                type="number" placeholder="NomorTelepon; Maximal 13 angka" name="nomor_telepon"
                                value="{{ old('nomor_telepon') }}" required maxlength="13"
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

                            @error('nomor_telepon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>


                <div class="form-group">
                    <button class="btn btn-success" type="submit">Simpan</button>
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
