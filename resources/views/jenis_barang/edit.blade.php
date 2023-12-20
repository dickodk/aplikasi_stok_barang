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
                    <form action="{{ route('jenis_barangs.update', $jenisBarang->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group">

                            <label for="">Jenis Barang</label>
                            <input
                                class="form-control @error('jenis_barang') is-invalid
                            @enderror"
                                type="text" name="jenis_barang" id=""
                                placeholder="Masukan jenis barang; Maximal 255 karakter"
                                value="{{ old('jenis_barang', $jenisBarang->Jenis_barang) }}" required maxlength="255">

                            @error('jenis_barang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
