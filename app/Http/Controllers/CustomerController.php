<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = customer::all();
        return view('customer.index')
        ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_customer' => 'required|max:50',
            'alamat' => 'required|max:200',
            'nomor_telepon' => 'required|max:13',
        ],
        [
            'nama_customer.required' => "Kolom :attribute tidak boleh kosong",
            'nama_customer.max' => "Kolom :attribute tidak boleh lebih dari 50 karakter",
            'alamat.required' => "Kolom :attribute tidak boleh kosong",
            'alamat.max' => "Kolom :attribute tidak boleh lebih dari 200 karakter",
            'nomor_telepon.required' => "Kolom :attribute tidak boleh kosong",
            'nomor_telepon.max' => "Kolom :attribute tidak boleh lebih dari 13 karakter",
        ]);

    $inputData = new customer();
    $inputData->nama_customer = $validateData['nama_customer'];
    $inputData->alamat = $validateData['alamat'];
    $inputData->nomor_telepon = $validateData['nomor_telepon'];
    $inputData->save();

    Session::flash('success', 'Data berhasil ditambahkan');

    return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        {
        //
        // dd($request);
        $this->authorize('update', $customer);

        $validateData = $request->validate([
            'nama_customer' => 'required|max:50',
            'alamat' => 'required|max:200',
            'nomor_telepon' => 'required|max:15',
            'status' => 'required|max:50'
        ],
        [
            'nama_customer.required' => "Kolom :attribute tidak boleh kosong",
            'nama_customer.max' => "Kolom :attribute tidak boleh lebih dari 50 karakter",
            'alamat.required' => "Kolom :attribute tidak boleh kosong",
            'alamat.max' => "Kolom :attribute tidak boleh lebih dari 200 karakter",
            'nomor_telepon.required' => "Kolom :attribute tidak boleh kosong",
            'nomor_telepon.max' => "Kolom :attribute tidak boleh lebih dari 15 karakter",
            'status.required' => "Kolom :attribute tidak boleh kosong",
        ]);


        $customer->update([
        'nama_customer' => $validateData['nama_customer'],
        'alamat' => $validateData['alamat'],
        'nomor_telepon' => $validateData['nomor_telepon'],
        'status' =>  $validateData['status'],
        ]);


        Session::flash('success','Data berhasil diubah');

        return redirect()->route('customers.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
         //
        $this->authorize('delete', $customer);
        $customer->delete();
        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }
}
