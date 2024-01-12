<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailBarangMasukController extends Controller
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
    public function create(BarangMasuk $barangMasuk)
    {
        //
        $barangs = barang::all();
        return view('detail_barang_masuk.create')
        ->with('barangs', $barangs)
        ->with('barangMasuk', $barangMasuk);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, BarangMasuk $barangMasuk)
    {
        //
        $getBarangMasukID = $barangMasuk->first()->id;
        // dd($getBarangMasukID);
        // proses input detail barang masuk
        $inputDetailBarangMasuk = new DetailBarangMasuk();
        $dataToInsert = [];

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            $dataToInsert[] = [
                'barangs_id' => $request->nama_barang[$i],
                'barang_masuks_id' => $getBarangMasukID,
                'qty' => $request->jumlah[$i],
                'harga_beli' => $request->harga[$i],
            ];
        }

        $inputDetailBarangMasuk->insert($dataToInsert);

        // update qty pada tabel barang
        for ($i=0; $i < count($request->nama_barang); $i++) {
            $getBarang = barang::findOrFail($request->nama_barang[$i]);
            $currentStok = $getBarang->qty;
            $addStok =  $request->jumlah[$i];
            $newStok = $currentStok + $addStok;

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
    public function show(DetailBarangMasuk $detailBarangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailBarangMasuk $detailBarangMasuk)
    {
        //
        $barangs = barang::all();

        return view('detail_barang_masuk.edit')
        ->with('detail_barang_masuk', $detailBarangMasuk)
        ->with('barangs', $barangs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailBarangMasuk $detailBarangMasuk)
    {
        //
         $this->authorize('edit', $detailBarangMasuk);
        $validate = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'hidden_barang' => 'required',
            'hidden_jumlah' => 'required',
            'hidden_harga' => 'required',
        ],
        [
            'nama_barang.required' => "Kolom :attribute tidak boleh kosong",
            'jumlah.required' => "Kolom :attribute tidak boleh kosong",
            'harga.required' => "Kolom :attribute tidak boleh kosong",
        ]);

        // update qty barang jika jumlah barang masuk diubah
        if ($validate['nama_barang'] !== $validate['hidden_barang']) {

            $oldBarang = barang::findOrFail($validate['hidden_barang']);
            $oldBarangQTY = $oldBarang->qty;
            $updateQtyOldBarang = $oldBarangQTY - $validate['hidden_jumlah'];

            $oldBarang->update(['qty' => $updateQtyOldBarang]);

            $newBarang = barang::findOrFail($validate['nama_barang']);
            $newBarangQTY = $newBarang->qty;
            $updateQtynewBarang = $newBarangQTY + $validate['jumlah'];

            $newBarang->update(['qty' => $updateQtynewBarang]);

        } elseif ($validate['jumlah'] !== $validate['hidden_jumlah']) {
            $getBarang = barang::findOrFail($validate['nama_barang']);

            $oldQty = $validate['hidden_jumlah'];
            $newQty = $validate['jumlah'];
            $currentQty = $getBarang->qty;

            if ($newQty > $oldQty) {
                $diff = $newQty - $oldQty;
                $currentQty = $currentQty + $diff;
            } else {
                // $newQty < $oldQty
                $diff = $oldQty - $newQty;
                $currentQty = $currentQty - $diff;
            }

            $getBarang->update(['qty' => $currentQty]);
        }

        $detailBarangMasuk->update([
            'barangs_id' => $validate['nama_barang'],
            'qty' => $validate['jumlah'],
            'harga_beli' => $validate['harga'],
        ]);

        Session::flash('success', 'Data berhasil diperbarui');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailBarangMasuk $detailBarangMasuk)
    {
        //
        // $getBarang = barang::findOrFail($validate['nama_barang']);

        // $delQty = $newQty - $oldQty;

        // $getBarang->destroy(['qty' => $delQty]);
        $this->authorize('delete', $detailBarangMasuk);
        $getBarang = barang::findOrFail($detailBarangMasuk->id_barang);
        $qtyBarang = $getBarang->qty;
        $qtyBarangMasuk = $detailBarangMasuk->qty;
        $diff = $qtyBarang - $qtyBarangMasuk;

        $getBarang->update(['qty' => $diff]);

        $detailBarangMasuk->delete();

        Session::flash('success', 'Data berhasil diperbarui');
        return redirect()->back();

    }
}
