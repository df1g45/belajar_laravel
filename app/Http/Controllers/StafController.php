<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;

class StafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stafs = Staf::all();

        return view('staf.index', ['stafs' => $stafs]);
    }
    public function create()
    {
        return view('staf.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15',
        ]);

        Staf::create($validatedData);

        return redirect(route('stafs.index'))->with('success', 'Pendaftaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get post by ID
        $staf = Staf::findOrFail($id);
        //render view with post
        return view('staf.show', compact('staf'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staf = Staf::findOrFail($id);

        return view('staf.edit', ['staf' => $staf]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staf = Staf::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15',
        ]);

        if ($staf->update($validatedData)) {

            return redirect(route('stafs.index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staf = Staf::findOrFail($id);

        if ($staf->delete()) {
            return redirect(route('stafs.index'))->with('success', 'Deleted!');
        }

        return redirect(route('stafs.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
