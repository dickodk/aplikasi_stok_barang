<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenisBarangs = JenisBarang::all();
        return view('jenis_barang.index')
        ->with('jenisBarangs', $jenisBarangs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'jenis_barang' => 'required|max:255|unique:jenis_barangs,Jenis_barang'
        ],
        [
            'jenis_barang.required' => "Kolom :attribute tidak boleh kosong",
            'jenis_barang.max' => "Kolom :attribute tidak boleh lebih dari 255 karakter",
        ]);

    $inputData = new JenisBarang();
    $inputData->jenis_barang = $validateData['jenis_barang'];
    $inputData->save();

    Session::flash('success','Data berhasil ditambahkan');

    // $request->session()->flash('success', 'Data berhasil ditambahkan');
    return redirect()->route('jenis_barangs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisBarang $jenisBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBarang $jenisBarang)
    {
        //
        return view('jenis_barang.edit')->with('jenisBarang', $jenisBarang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisBarang $jenisBarang)
    {
        //
        // dd($request);
        $this->authorize('update', $jenisBarang);
        $validateData = $request->validate([
            'jenis_barang' => 'required|max:255'
        ],
        [
            'jenis_barang.required' => "Kolom :attribute tidak boleh kosong",
            'jenis_barang.max' => "Kolom :attribute tidak boleh lebih dari 255 karakter",
        ]);

        // $getJenisBarang = JenisBarang::find($jenisBarang->id);
        $jenisBarang->update([
            'jenis_barang' => $validateData['jenis_barang']
        ]);


        Session::flash('success','Data berhasil diubah');

        return redirect()->route('jenis_barangs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisBarang $jenisBarang)
    {
        //
        $this->authorize('delete', $jenisBarang);
        $jenisBarang->delete();

        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
        }
}
