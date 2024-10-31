<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();

        return view('obat.index', ['obats' => $obats]);
    }
    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'kadaluarsa' => 'required|date|after_or_equal:today',
        ]);

        Obat::create($validatedData);

        return redirect(route('obats.index'))->with('success', 'Pendaftaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get post by ID
        $obat = Obat::findOrFail($id);
        //render view with post
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $obat = Obat::findOrFail($id);

        return view('obat.edit', ['obat' => $obat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obat = Obat::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'kadaluarsa' => 'required|date|after_or_equal:today',
        ]);

        if ($obat->update($validatedData)) {

            return redirect(route('obats.index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obat = Obat::findOrFail($id);

        if ($obat->delete()) {
            return redirect(route('obats.index'))->with('success', 'Deleted!');
        }

        return redirect(route('obats.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
