<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barang_masuks = BarangMasuk::all();
        return view('barang_masuk.index')
        ->with('barang_masuks', $barang_masuks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $suppliers = supplier::all();
        return view('barang_masuk.create')
        -> with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'id_supplier' => 'required',
            'tgl_penerimaan' => 'required',
            'qty' => 'required',
        ],
        [
            'id_supplier.required' => "Kolom :attribute tidak boleh kosong",
            'tgl_penerimaan.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",

        ]);


    $inputData = new BarangMasuk();
    $inputData->id_supplier = $validateData['id_supplier'];
    $inputData->tgl_penerimaan = $validateData['tgl_penerimaan'];
    $inputData->qty = $validateData['qty'];
    $inputData->save();

    Session::flash('success', 'Data berhasil ditambahkan');

    return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        // //
        $suppliers = supplier::all();
        return view('barang_masuk.edit')
        -> with('suppliers', $suppliers) ->with('barang_masuk', $barangMasuk);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
        $validateData = $request->validate([
            'id_supplier' => 'required',
            'tgl_penerimaan' => 'required',
            'qty' => 'required',
        ],
        [
            'id_supplier.required' => "Kolom :attribute tidak boleh kosong",
            'tgl_penerimaan.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",

        ]);


        $barangMasuk->update([
        'id_supplier' => $validateData['id_supplier'],
        'tgl_penerimaan' => $validateData['tgl_penerimaan'],
        'qty' => $validateData['qty'],
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
        $barangMasuk->delete();
        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }
}
