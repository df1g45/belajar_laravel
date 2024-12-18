<?php

namespace App\Http\Controllers\Api;

use App\Models\DataServis;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataServisResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataServisController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $dataServis = DataServis::with('daftarServis')->paginate(10);
        return new DataServisResource(true, 'List Data Servis', $dataServis);
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
            'id_service' => 'required|numeric|exists:daftar_servis,id_service',
            'estimasi_service' => 'required|string|max:255',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create Data Service
        $servis = DataServis::create([
            'id_service'            => $request->id_service,
            'estimasi_service'      => $request->estimasi_service,
            'nama_mekanik'          => $request->nama_mekanik,
            'sparepart_pengganti'   => $request->sparepart_pengganti,
        ]);

        return new DataServisResource(true, 'Data servis Berhasil Ditambahkan!', $servis);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find Data Service by ID
        $daftarServis = DataServis::with(['daftarServis'])->find($id);

        //return response
        return new DataServisResource(true, 'Detail Data Servis!', $daftarServis);
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
            'id_service' => 'required|numeric|exists:daftar_servis,id_service',
            'estimasi_service' => 'required|string|max:255',
            'nama_mekanik' => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string|max:255',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find Data Service by ID
        $dataservis = DataServis::find($id);

        //create Data Service
        $dataservis->update([
            'id_service'            => $request->id_service,
            'estimasi_service'      => $request->estimasi_service,
            'nama_mekanik'          => $request->nama_mekanik,
            'sparepart_pengganti'   => $request->sparepart_pengganti,
        ]);

        //return response
        return new DataServisResource(true, 'Data Servis Berhasil Diubah!', $dataservis);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find Data Service by ID
        $dataService = DataServis::find($id);

        //delete Data Service
        $dataService->delete();
        //return response
        return new DataServisResource(true, 'Data Servis Berhasil Dihapus!', null);
    }
}
