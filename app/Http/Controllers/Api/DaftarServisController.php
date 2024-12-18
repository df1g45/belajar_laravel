<?php

namespace App\Http\Controllers\Api;

use App\Models\DaftarServis;
use App\Http\Controllers\Controller;
use App\Http\Resources\DaftarServisResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaftarServisController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $servis = DaftarServis::with(['kendaraan', 'pelanggan'])->paginate(10);
        return new DaftarServisResource(true, 'List Data Daftar Servis', $servis);
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
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|numeric|exists:pelangganns,id_pelanggan',
            'keluhan' => 'required|string',
            'tanggal_service' => 'required|date',
        ]);
        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create Daftar Service
        $servis = DaftarServis::create([
            'no_plat'           => $request->no_plat,
            'id_pelanggan'      => $request->id_pelanggan,
            'keluhan'           => $request->keluhan,
            'tanggal_service'   => $request->tanggal_service,
        ]);

        return new DaftarServisResource(true, 'Data daftar servis Berhasil Ditambahkan!', $servis);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find Daftar Service by ID
        $daftarServis = DaftarServis::with(['kendaraan', 'pelanggan'])->find($id);

        //return response
        return new DaftarServisResource(true, 'Detail Data Daftar Servis!', $daftarServis);
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
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|numeric|exists:pelangganns,id_pelanggan',
            'keluhan' => 'required|string',
            'tanggal_service' => 'required|date',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find Daftar Service by ID
        $daftarservis = DaftarServis::find($id);

        //create Daftar Service
        $daftarservis->update([
            'no_plat'           => $request->no_plat,
            'id_pelanggan'      => $request->id_pelanggan,
            'keluhan'           => $request->keluhan,
            'tanggal_service'   => $request->tanggal_service,
        ]);

        //return response
        return new DaftarServisResource(true, 'Data Daftar Servis Berhasil Diubah!', $daftarservis);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find Daftar Service by ID
        $daftarService = DaftarServis::find($id);

        //delete Daftar Service
        $daftarService->delete();
        //return response
        return new DaftarServisResource(true, 'Data Daftar Servis Berhasil Dihapus!', null);
    }
}
