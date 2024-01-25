<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\JenisBarang;
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
        $jenis_barangs = JenisBarang::all();
        $barangs = barang::all();
        return view('barang_masuk.create')
        -> with('suppliers', $suppliers)
        -> with('jenis_barangs', $jenis_barangs)
        -> with('barangs', $barangs);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // proses input barang masuk
        $inputBarangMasuk = new BarangMasuk();
        $inputBarangMasuk->suppliers_id = $request->suppliers_id;
        $inputBarangMasuk->tgl_penerimaan = $request->tgl_penerimaan;
        $inputBarangMasuk->save();

        // Mengambil ID setelah penyimpanan
        $newlyInsertedId = $inputBarangMasuk->id;

        // proses input detail barang masuk
        $inputDetailBarangMasuk = new DetailBarangMasuk();
        $dataToInsert = [];

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            $dataToInsert[] = [
                'barangs_id' => $request->nama_barang[$i],
                'barang_masuks_id' => $newlyInsertedId,
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
        return redirect()->route('barang_masuks.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
        $detailBarangMasuk = DetailBarangMasuk::where('barang_masuks_id', $barangMasuk->id)
        ->orderBy('id', 'asc')
        ->get();
        // dd($detailBarangMasuk);
        return view('barang_masuk.detail')
        ->with('barangMasuk', $barangMasuk)
        ->with('detailBarangMasuk', $detailBarangMasuk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        // //
    // public function edit(BarangMasuk $barangMasuk)
    // {
        // Pastikan model BarangMasuk ditemukan
        if (!$barangMasuk) {
            return abort(404); // Atau Anda dapat mengarahkannya ke halaman lain sesuai kebutuhan
    }

        $suppliers = Supplier::all(); // Pastikan "S" besar untuk model Supplier
        return view('barang_masuk.edit')
            ->with('suppliers', $suppliers)
            ->with('barangMasuk', $barangMasuk);
    }


        // $suppliers = supplier::all();
        // return view('barang_masuk.edit')
        // -> with('suppliers', $suppliers) ->with('barang_masuk', $barangMasuk);

    //}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
        $this->authorize('update', $barangMasuk);
        $validateData = $request->validate([
            'suppliers_id' => 'required',
            'tgl_penerimaan' => 'required',
            'qty' => 'required',
        ],
        [
            'suppliers_id.required' => "Kolom :attribute tidak boleh kosong",
            'tgl_penerimaan.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",

        ]);


        $barangMasuk->update([
        'suppliers_id' => $validateData['suppliers_id'],
        'tgl_penerimaan' => $validateData['tgl_penerimaan'],
        'qty' => $validateData['qty'],
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('barang_masuks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
        $this->authorize('delete', $barangMasuk);
        $detailBarangMasuk = DetailBarangMasuk::where('id_barang_masuk', $barangMasuk->id)->get();
        // dd($detailBarangMasuk);
        foreach ($detailBarangMasuk as $item) {
            $getBarang = barang::findOrFail($item->id_barang);
            $qtyBarang = $getBarang->qty;

            $qtyBarangMasuk = $item->qty;
            $diff = $qtyBarang - $qtyBarangMasuk;

            $getBarang->update(['qty' => $diff]);

            $item->delete();
        }

        $barangMasuk->delete();
        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }

}
