<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Dashboard;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jumlahSuppliers = supplier::all();
        $jumlahCustomers = customer::all();
        $jumlahBarangKeluars = barangKeluar::all();
        $jumlahBarangMasuks = BarangMasuk::all();
        return view('dashboard')
        ->with('suppliers', $jumlahSuppliers)
        ->with('customers', $jumlahCustomers)
        ->with('barang_keluars', $jumlahBarangKeluars)
        ->with('barang_masuks', $jumlahBarangMasuks)
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Dashboard $dashboard)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
