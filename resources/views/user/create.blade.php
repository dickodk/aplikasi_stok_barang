@extends('layouts.master1')
@section('main_content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Tambah</h1>
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
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input class="form-control @error('name') is-invalid
                            @enderror"
                                type="text" name="name" id="" placeholder="Nama User; Maximal 30 karakter"
                                value="{{ old('name') }}" required maxlength="30">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control @error('email') is-invalid
                            @enderror"
                                type="text" name="email" id="" placeholder="Email; Maximal 30 karakter"
                                value="{{ old('email') }}" required maxlength="30">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control @error('password') is-invalid
                            @enderror"
                                type="text" name="password" id="" placeholder="Password; Maximal 30 karakter"
                                value="{{ old('password') }}" required maxlength="30">

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Role</label>
                            <input class="form-control @error('role') is-invalid
                            @enderror"
                                type="text" name="role" id="" placeholder="Role; Maximal 30 karakter"
                                value="{{ old('role') }}" required maxlength="30">

                            @error('role')
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
