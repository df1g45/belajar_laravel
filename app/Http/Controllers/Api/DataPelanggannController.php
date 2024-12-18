<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggann;
use App\Http\Controllers\Controller;
use App\Http\Resources\PelanggannResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPelanggannController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pelanggan = Pelanggann::paginate(10);
        // return PelanggannResource::collection($pelanggan);
        return new PelanggannResource(true, 'List Data Pelanggan', $pelanggan);
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
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create pelanggan
        $pelanggan = Pelanggann::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'no_hp'         => $request->no_hp,
            'alamat'        => $request->alamat,
            'pekerjaan'     => $request->pekerjaan,
        ]);

        //return response
        return new PelanggannResource(true, 'Data Pelanggan Berhasil Ditambahkan!', $pelanggan);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find pelanggan by ID
        $pelanggan = Pelanggann::find($id);

        //return response
        return new PelanggannResource(true, 'Detail Data Pelanggan!', $pelanggan);
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
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find pelanggan by ID
        $pelanggan = Pelanggann::find($id);

         //update pelanggan
         $pelanggan->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'no_hp'         => $request->no_hp,
            'alamat'        => $request->alamat,
            'pekerjaan'     => $request->pekerjaan,
        ]);

        
        //return response
        return new PelanggannResource(true, 'Data Pelanggan Berhasil Diubah!', $pelanggan);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find pelanggan by ID
        $pelanggan = Pelanggann::find($id);

        //delete pelanggan
        $pelanggan->delete();
        //return response
        return new PelanggannResource(true, 'Data Pelanggan Berhasil Dihapus!', null);
    }
}
