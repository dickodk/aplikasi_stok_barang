<?php

namespace App\Http\Controllers;


use App\Models\barang;
use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailBarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BarangKeluar $barangKeluar)
    {
        //
        $barangs = barang::all();
        return view('detail_barang_keluar.create')
        ->with('barangs', $barangs)
        ->with('barangKeluar', $barangKeluar);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, BarangKeluar $barangKeluar)
    {
        //
        $getBarangKeluarID = $barangKeluar->first()->id;
        // proses input detail barang keluar
        $inputDetailBarangKeluar = new DetailBarangKeluar();
        $dataToInsert = [];

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            $dataToInsert[] = [
                'barangs_id' => $request->nama_barang[$i],
                'barang_keluars_id' => $getBarangKeluarID,
                'qty' => $request->jumlah[$i],
                'harga_jual' => $request->harga[$i],
            ];
        }

        $inputDetailBarangKeluar->insert($dataToInsert);

        // update qty pada tabel barang
        for ($i=0; $i < count($request->nama_barang); $i++) {
            $getBarang = barang::findOrFail($request->nama_barang[$i]);
            $currentStok = $getBarang->qty;
            $addStok =  $request->jumlah[$i];
            $newStok = $currentStok - $addStok;

            $getBarang->update([
                'qty' => $newStok,
            ]);
        }



        Session::flash('success', 'Data telah ditambahkan dan stok baranag telah di update');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailBarangKeluar $detailBarangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailBarangKeluar $detailBarangKeluar)
    {
        //
        $barangs = barang::all();

        return view('detail_barang_keluar.edit')
        ->with('detail_barang_keluar', $detailBarangKeluar)
        ->with('barangs', $barangs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailBarangKeluar $detailBarangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailBarangKeluar $detailBarangKeluar)
    {
        //
        $this->authorize('edit', $detailBarangKeluar);
        $getBarang = barang::findOrFail($detailBarangKeluar->id_barang);
        $qtyBarang = $getBarang->qty;
        $qtyBarangMasuk = $detailBarangKeluar->qty;
        $diff = $qtyBarang - $qtyBarangMasuk;

        $getBarang->update(['qty' => $diff]);

        $detailBarangKeluar->delete();

        Session::flash('success', 'Data berhasil diperbarui');
        return redirect()->back();
    }
}
