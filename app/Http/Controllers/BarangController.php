<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangKeluar;
use App\Models\DetailBarangMasuk;
use App\Models\JenisBarang;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $barangs = barang::all();
        return view('barang.index')
        ->with('barangs', $barangs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenisBarangs = JenisBarang::all();
        return view('barang.create')
        ->with('jenisBarangs', $jenisBarangs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
        //  dd('bang');
        $validateData = $request->validate([
            'nama_barang' => 'required|max:30|unique:barangs,nama_barang',
            'harga_jual' => 'required',
            'qty' => 'required|max:20',
            'jenis_barangs_id' => 'required',
        ],
        [
            'nama_barang.required' => "Kolom :attribute tidak boleh kosong",
            'nama_barang.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'harga_jual.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",
            'qty.max' => "Kolom :attribute tidak boleh lebih dari 20 karakter",
            'jenis_barangs_id.required' => "Kolom :attribute tidak boleh kosong",

        ]);


    $inputData = new barang();
    $inputData->nama_barang = $validateData['nama_barang'];
    $inputData->harga_jual = $validateData['harga_jual'];
    $inputData->qty = $validateData['qty'];
    $inputData->jenis_barangs_id = $validateData['jenis_barangs_id'];
        //dd($inputData);
    $inputData->save();

    Session::flash('success', 'Data berhasil ditambahkan');

    return redirect()->route('barangs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barang $barang)
    {
        //
        $jenisBarang = JenisBarang::all();
        return view('barang.edit')
        ->with ('barang', $barang) ->with('jenisBarang', $jenisBarang) ;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, barang $barang)
    {
        //
        // dd($request);
        $this->authorize('update', $barang);
        $validateData = $request->validate([
            'nama_barang' => 'required|max:30',
            'harga_jual' => 'required|max:50',
            'qty' => 'required',
            'jenis_barangs_id' => 'required',

        ],
        [
            'nama_barang.required' => "Kolom :attribute tidak boleh kosong",
            'nama_barang.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'harga_jual.required' => "Kolom :attribute tidak boleh kosong",
            'harga_jual.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'qty.required' => "Kolom :attribute tidak boleh kosong",
            'jenis_barang_id.required' => "Kolom :attribute tidak boleh kosong",
        ]);


        $barang->update([
        'nama_barang' => $validateData['nama_barang'],
        'harga_jual' => $validateData['harga_jual'],
        'qty' => $validateData['qty'],
        'jenis_barangs_id' => $validateData['jenis_barangs_id'],
        ]);


        Session::flash('success','Data berhasil diubah');

        return redirect()->route('barangs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barang $barang)
    {
        //
        $this->authorize('delete', $barang);
        $check = DetailBarangMasuk::where('barangs_id', $barang['id'])->first();

        if($check){
        Session::flash('danger','Data tidak diizinkan dihapus');

        }else{
        $barang->delete();

        Session::flash('success','Data berhasil dihapus');
        }

        return redirect()->back();
    }
}
