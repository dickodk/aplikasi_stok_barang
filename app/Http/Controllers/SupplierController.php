<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $suppliers = supplier::all();
        return view('supplier.index')
        ->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:200',
            'nomor_telepon' => 'required|max:13',
        ],
        [
            'nama_supplier.required' => "Kolom :attribute tidak boleh kosong",
            'nama_supplier.max' => "Kolom :attribute tidak boleh lebih dari 50 karakter",
            'alamat.required' => "Kolom :attribute tidak boleh kosong",
            'alamat.max' => "Kolom :attribute tidak boleh lebih dari 200 karakter",
            'nomor_telepon.required' => "Kolom :attribute tidak boleh kosong",
            'nomor_telepon.max' => "Kolom :attribute tidak boleh lebih dari 13 karakter",
        ]);


        $inputData = new supplier();
        $inputData->nama_supplier = $validateData['nama_supplier'];
        $inputData->alamat = $validateData['alamat'];
        $inputData->nomor_telepon = $validateData['nomor_telepon'];
        $inputData->save();

        Session::flash('success','Data berhasil ditambahkan');

        // $request->session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(supplier $supplier)
    {
        //
        return view('supplier.edit')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, supplier $supplier)
    {
        {
        //
        // dd($request);
        $this->authorize('update', $supplier);
        $validateData = $request->validate([
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:200',
            'nomor_telepon' => 'required|max:13',
        ],
        [
            'nama_supplier.required' => "Kolom :attribute tidak boleh kosong",
            'nama_supplier.max' => "Kolom :attribute tidak boleh lebih dari 50 karakter",
            'alamat.required' => "Kolom :attribute tidak boleh kosong",
            'alamat.max' => "Kolom :attribute tidak boleh lebih dari 200 karakter",
            'nomor_telepon.required' => "Kolom :attribute tidak boleh kosong",
            'nomor_telepon.max' => "Kolom :attribute tidak boleh lebih dari 13 karakter",
        ]);

        // $getSupplier = supplier::find($supplier->id);
        $supplier->update([
        'nama_supplier' => $validateData['nama_supplier'],
        'alamat' => $validateData['alamat'],
        'nomor_telepon' => $validateData['nomor_telepon'],
        ]);


        Session::flash('success','Data berhasil diubah');

        return redirect()->route('suppliers.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(supplier $supplier)
    {
        //
        $this->authorize('delete', $supplier);
        $supplier->delete();

        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();

    }
    public function countData()
    {
        $countData = supplier::count(); // Adjust the model name as needed
            // dd($countData);
        return view('dashboard', compact('countData'));
    }


}
