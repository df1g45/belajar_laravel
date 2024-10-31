<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();

        return view('pelanggan.index', ['pelanggans' => $pelanggans]);
    }
    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        Pelanggan::create($validatedData);

        return redirect(route('pelanggans.index'))->with('success', 'Pendaftaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get post by ID
        $pelanggan = Pelanggan::findOrFail($id);
        //render view with post
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        if ($pelanggan->update($validatedData)) {

            return redirect(route('pelanggans.index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        if ($pelanggan->delete()) {
            return redirect(route('pelanggans.index'))->with('success', 'Deleted!');
        }

        return redirect(route('pelanggans.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
