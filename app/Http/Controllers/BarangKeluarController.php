<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barangKeluar = BarangMasuk::all();
        return view('barang_keluar.index')
        ->with('barangKeluar', $barangKeluar);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jenis_barang.create');
        // $customers = customer::all();
        // return view('barang_keluar.create')
        // ->with('customers' $customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }
}
