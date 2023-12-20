@extends('layouts.master')

@section('main_content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">1</a></li>
                            <li class="breadcrumb-item active">2</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                {{-- card data table --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Data Barang</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Data Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($barangs) > 0)
                                    @foreach ($barangs as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->Jenis_barang }}</td>
                                            <td><button class="btn btn-warning">Edit</button> <button
                                                    class="btn btn-danger">Delete</button></td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"><i>Belum ada data yang diinputkan</i></td>
                                    </tr>
                                @endif
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Jenis Barang</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>

                </div>

            </div>

    </div>

    </div>
    </section>

    </div>
@endsection
