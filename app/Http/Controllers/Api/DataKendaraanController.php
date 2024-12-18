<?php

namespace App\Http\Controllers\Api;

use App\Models\Kendaraan;
use App\Http\Controllers\Controller;
use App\Http\Resources\KendaraanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKendaraanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $kendaraan = Kendaraan::paginate(10);
        return new KendaraanResource(true, 'List Data Kendaraan', $kendaraan);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
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
        return new KendaraanResource(true, 'Data Kendaraan Berhasil Ditambahkan!', $kendaraan);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find kendaraan by ID
        $kendaraan = Kendaraan::find($id);

        //return response
        return new KendaraanResource(true, 'Detail Data Kendaraan!', $kendaraan);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
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
        return new KendaraanResource(true, 'Data Pelanggan Berhasil Diubah!', $kendaraan);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find kendaraan by ID
        $kendaraan = Kendaraan::find($id);

        //delete kendaraan
        $kendaraan->delete();
        //return response
        return new KendaraanResource(true, 'Data Kendaraan Berhasil Dihapus!', null);
    }
}
