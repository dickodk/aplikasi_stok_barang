@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Edit</h1>
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
                    <form action="{{ route('barang_masuks.update', $barangMasuk->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="">Tanggal Terima</label>
                            <input
                                class="form-control @error('tgl_penerimaan') is-invalid
                                @enderror"
                                type="date" name="tgl_penerimaan" id=""
                                value="{{ old('tgl_penerimaan', $barangMasuk->tgl_penerimaan) }}" required>
                            @error('tgl_penerimaan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>id Supplier</label>
                            <select class="custom-select  @error('suppliers_id') is-invalid @enderror"
                                fdprocessedid="4k1jpe" name="suppliers_id" required>
                                <option value="">--Nama Supplier--</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('suppliers_id') == $item->id ? 'selected' : $barangMasuk->suppliers_id == $item->id) ? 'selected' : null }}>
                                        {{ $item->nama_supplier }}</option>
                                @endforeach
                            </select>
                            @error('suppliers_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="">qty</label>
                            <input class="form-control @error('qty') is-invalid
                            @enderror"
                                type="number" placeholder="qty" name="qty" value="{{ old('qty', $barangMasuk->qty) }}"
                                required>
                            @error('qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
