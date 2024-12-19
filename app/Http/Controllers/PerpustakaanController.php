<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Perpustakaan;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $perpustakaans = Perpustakaan::paginate(10);
        return view('perpustakaan.index', ['perpustakaans' => $perpustakaans]);
    }


    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:15',
            'tanggal_publikasi' => 'required|date',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create perpustakaan
        $perpustakaan = Perpustakaan::create([
            'judul_buku'        => $request->judul_buku,
            'pengarang'         => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ]);

        return redirect()->route('perpustakaan.index')->with('success', 'Data berhasil ditambahkan!');
    }
    public function edit($id)
    {
        //find perpustakaan by ID
        $perpustakaans = Perpustakaan::all();
        $perpustakaan = Perpustakaan::find($id);
        return view('perpustakaan.index', compact('perpustakaan', 'perpustakaans'));
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:15',
            'tanggal_publikasi' => 'required|date',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find perpustakaan by ID
        $perpustakaan = Perpustakaan::find($id);

         //update perpustakaan
         $perpustakaan->update([
            'judul_buku'        => $request->judul_buku,
            'pengarang'         => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ]);

        return redirect()->route('perpustakaan.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        //find perpustakaan by ID
        $perpustakaan = Perpustakaan::find($id);

        //delete perpustakaan
        $perpustakaan->delete();

        return redirect(route('perpustakaan.index'))->with('success', 'Deleted!');
    }
}
