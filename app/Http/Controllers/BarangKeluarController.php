<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
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
        $barang_keluars = BarangKeluar::all();
        return view('barang_keluar.index')
        ->with('barang_keluars', $barang_keluars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customers = customer::all();
        return view('barang_keluar.create')
        ->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'id_customer' => 'required',
            'tgl_pengiriman' => 'required',
            'qty' => 'required',
            'no_surat_jalan' => 'required',
            'diskon' => 'required',
            'ppn' => 'required'
        ],
        [
            'id_customer.required' => "Kolom :attribute tidak boleh kosong",
            'tgl_pengiriman.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",
            'no_surat_jalan.required' => "Kolom :attribute tidak boleh kosong",
            'diskon.required' => "Kolom :attribute tidak boleh kosong",
            'ppn.required' => "Kolom :attribute tidak boleh kosong",
        ]);

        $inputData = new BarangKeluar();
        $inputData->id_customer = $validateData['id_customer'];
        $inputData->tgl_pengiriman = $validateData['tgl_pengiriman'];
        $inputData->qty = $validateData['qty'];
        $inputData->no_surat_jalan = $validateData['no_surat_jalan'];
        $inputData->diskon = $validateData['diskon'];
        $inputData->ppn = $validateData['ppn'];
        $inputData->save();

        Session::flash('success', 'Data berhasil ditambahkan');

        return redirect()->back();

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
        $barangKeluar->delete();
        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }
}
