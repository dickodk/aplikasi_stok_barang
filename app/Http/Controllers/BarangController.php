<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\JenisBarang;
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
            'id_jenis_barang' => 'required',
        ],
        [
            'nama_barang.required' => "Kolom :attribute tidak boleh kosong",
            'nama_barang.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'harga_jual.required' => "Kolom :attribute tidak boleh kosong",
            'qty.required' => "Kolom :attribute tidak boleh kosong",
            'qty.max' => "Kolom :attribute tidak boleh lebih dari 20 karakter",
            'id_jenis_barang.required' => "Kolom :attribute tidak boleh kosong",

        ]);


    $inputData = new barang();
    $inputData->nama_barang = $validateData['nama_barang'];
    $inputData->harga_jual = $validateData['harga_jual'];
    $inputData->qty = $validateData['qty'];
    $inputData->id_jenis_barang = $validateData['id_jenis_barang'];
        //dd($inputData);
    $inputData->save();

    Session::flash('success', 'Data berhasil ditambahkan');

    return redirect()->back();
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
        $validateData = $request->validate([
            'nama_barang' => 'required|max:30',
            'harga_jual' => 'required|max:50',
            'qty' => 'required',
            'id_jenis_barang' => 'required',

        ],
        [
            'nama_barang.required' => "Kolom :attribute tidak boleh kosong",
            'nama_barang.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'harga_jual.required' => "Kolom :attribute tidak boleh kosong",
            'harga_jual.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'qty.required' => "Kolom :attribute tidak boleh kosong",
            'id_jenis_barang.required' => "Kolom :attribute tidak boleh kosong",
        ]);


        $barang->update([
        'nama_barang' => $validateData['nama_barang'],
        'harga_jual' => $validateData['harga_jual'],
        'qty' => $validateData['qty'],
        'id_jenis_barang' => $validateData['id_jenis_barang'],
        ]);


        Session::flash('success','Data berhasil diubah');

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barang $barang)
    {
        //
        $barang->delete();
        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }
}
