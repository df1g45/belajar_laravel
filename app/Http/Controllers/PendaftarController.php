<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = Pendaftar::all();

        return view('registration.index', ['pendaftars' => $pendaftars]);
    }
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'hobi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:pendaftars',
            'nama_ayah' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:pendaftars',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Menghasilkan nama file unik
            $imageName = \Str::slug($request->nama, '-')
                . '-'
                . time()
                . '-'
                . $request->foto->getClientOriginalExtension();

            // Menyimpan gambar ke storage publik dan mendapatkan path-nya
            $imagePath = $request->foto->storeAs('public/foto', $imageName, 'local');

            $validatedData['foto'] = $imageName;
        }

        Pendaftar::create($validatedData);

        return redirect(route('pendaftaran.index'))->with('success', 'Pendaftaran berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get post by ID
        $pendaftar = Pendaftar::findOrFail($id);
        //render view with post
        return view('registration.show', compact('pendaftar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        return view('registration.edit', ['pendaftar' => $pendaftar]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'hobi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:pendaftars,email,' . $pendaftar->id,
            'nama_ayah' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:pendaftars,nik,' . $pendaftar->id,
        ]);



        if ($request->foto) {
            Storage::disk('local')->delete('public/foto/' . $pendaftar->foto);

            if ($request->hasFile('foto')) {
                // Menghasilkan nama file unik
                $imageName = \Str::slug($request->nama, '-')
                    . '-'
                    . time()
                    . '-'
                    . $request->foto->getClientOriginalExtension();

                // Menyimpan gambar ke storage publik dan mendapatkan path-nya
                $imagePath = $request->foto->storeAs('public/foto', $imageName, 'local');

                $validatedData['foto'] = $imageName;
            }
        } else {
            $validatedData['foto'] = $pendaftar->foto;
        }


        if ($pendaftar->update($validatedData)) {

            return redirect(route('pendaftaran.index'))->with('success', 'Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        if ($pendaftar->foto) {
            Storage::disk('local')->delete('public/foto/' . $pendaftar->foto);
        }

        if ($pendaftar->delete()) {
            return redirect(route('pendaftaran.index'))->with('success', 'Deleted!');
        }

        return redirect(route('pendaftaran.index'))->with('error', 'Sorry, unable to delete this!');
    }
}
