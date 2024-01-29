<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('viewAny', User::class);
        $Users = User::all();
        return view('user.index')
        ->with('users', $Users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|max:30',
            'password' => 'required|max:30',
            'role' => 'required|max:30',
        ],
        [
            'name.required' => "Kolom :attribute tidak boleh kosong",
            'name.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'email.required' => "Kolom :attribute tidak boleh kosong",
            'email.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'password.required' => "Kolom :attribute tidak boleh kosong",
            'password.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
            'role.required' => "Kolom :attribute tidak boleh kosong",
            'role.max' => "Kolom :attribute tidak boleh lebih dari 30 karakter",
        ]);


        $inputData = new user();
        $inputData->name = $validateData['name'];
        $inputData->email = $validateData['email'];
        $inputData->password = Hash::make($validateData['password']);
        $inputData->role = $validateData['role'];
        $inputData->save();

        Session::flash('success','Data berhasil ditambahkan');

        // $request->session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();

        Session::flash('success','Data berhasil dihapus');
        return redirect()->back();
    }
}
