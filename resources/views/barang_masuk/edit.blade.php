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
                    <form action="{{ route('barang_masuks.store') }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Tanggal Terima</label>
                                <input
                                    class="form-control @error('tgl_penerimaan') is-invalid
                                @enderror"
                                    type="tgl_penerimaan" name="tgl_penerimaan"
                                    value="{{ old('tgl_penerimaan', $barang_masuks->tgl_penerimaan) }}" required>
                                @error('tgl_penerimaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>id Supplier</label>
                            <select class="custom-select  @error('id_suppliers') is-invalid @enderror"
                                fdprocessedid="4k1jpe" name="id_suppliers" required>
                                <option value="">--Nama Supplier--</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}">{{ $item->id_suppliers }}</option>
                                @endforeach
                            </select>
                            @error('id_suppliers')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="">qty</label>
                            <input class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty" name="qty" value="{{ old('qty', $barangMasuks->qty) }}"
                                required
                                oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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

            {{-- <div class="card-footer">
                Footer
            </div> --}}

    </div>

    </section>

    </div>
@endsection
