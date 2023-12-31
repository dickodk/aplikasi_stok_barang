<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangKeluar;
use App\Models\customer;
use App\Models\DetailBarangKeluar;
use App\Models\JenisBarang;
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
        $jenis_barangs = JenisBarang::all();
        $barangs = barang::all();
        return view('barang_keluar.create')
        ->with('customers', $customers)
        ->with('jenis_barangs', $jenis_barangs)
        ->with('barangs', $barangs);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
// dd("ll");
        // Proses Input Barang Keluar
        $inputBarangKeluar = new BarangKeluar();
        $inputBarangKeluar->id_customer = $request->id_customer;
        $inputBarangKeluar->tgl_pengiriman = $request->tgl_pengiriman;
        // dd($inputBarangKeluar);
        // $inputBarangKeluar->save();

        // Mengambil ID setelah penyimpanan
        $newlyInsertedId = $inputBarangKeluar->id;

        // proses input detail barang keluar
        $inputDetailBarangKeluar = new DetailBarangKeluar();
        $dataToInsert = [];

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            $dataToInsert[] = [
                'id_barang' => $request->nama_barang[$i],
                'id_barang_keluar' => $newlyInsertedId,
                'qty' => $request->jumlah[$i],
                'harga_jual' => $request->harga[$i],
            ];
        }
        dd($dataToInsert);

        $inputDetailBarangKeluar->insert($dataToInsert);

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
