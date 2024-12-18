<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::paginate(10);
        return view('servisMotor.kendaraan.index', ['kendaraans' => $kendaraans]);
    }

    public function create()
    {
        return view('servisMotor.kendaraan.create');
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'no_plat' => 'required|unique:kendaraans',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|integer',
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create Kendaraan
        $kendaraan = Kendaraan::create([
            'no_plat'           => $request->no_plat,
            'jenis_kendaraan'   => $request->jenis_kendaraan,
            'no_stnk'           => $request->no_stnk,
            'tahun_pembuatan'   => $request->tahun_pembuatan,
            'nama_pemilik'      => $request->nama_pemilik,
            'warna'             => $request->warna,
        ]);

        //return response
        return redirect(route('kendaraan.index'))->with('success', 'Kendaraan berhasil disimpan!');
    }

    public function edit($id)
    {
        //find kendaraan by ID
        $kendaraan = Kendaraan::find($id);

        //return response
        return view('servisMotor.kendaraan.edit', ['kendaraan' => $kendaraan]);
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|integer',
            'nama_pemilik' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find pelanggan by ID
        $kendaraan = Kendaraan::find($id);

        //create Kendaraan
        $kendaraan->update([
            'jenis_kendaraan'   => $request->jenis_kendaraan,
            'no_stnk'           => $request->no_stnk,
            'tahun_pembuatan'   => $request->tahun_pembuatan,
            'nama_pemilik'      => $request->nama_pemilik,
            'warna'             => $request->warna,
        ]);

        //return response
        return redirect(route('kendaraan.index'))->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        //find kendaraan by ID
        $kendaraan = Kendaraan::find($id);

        //delete kendaraan
        $kendaraan->delete();
        //return response
        return redirect(route('kendaraan.index'))->with('success', 'Deleted!');
    }
}
