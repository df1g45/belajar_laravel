<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembayaran;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembayaranResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('daftarServis')->paginate(10);
        return new PembayaranResource(true, 'List Data Pembayaran Servis', $pembayaran);
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
            'id_service' => 'required|exists:daftar_servis,id_service',
            'jumlah_biaya' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string|max:255',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //create pembayaran
        $servis = Pembayaran::create([
            'id_service'        => $request->id_service,
            'jumlah_biaya'      => $request->jumlah_biaya,
            'jenis_pembayaran'  => $request->jenis_pembayaran,
            'keterangan'        => $request->keterangan,
        ]);

        return new PembayaranResource(true, 'Data pembayaran Berhasil Ditambahkan!', $servis);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find Data pembayaran by ID
        $pembayaran = Pembayaran::with(['daftarServis'])->find($id);

        //return response
        return new PembayaranResource(true, 'Detail Data Pembayaran!', $pembayaran);
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
            'jumlah_biaya' => 'required|numeric',
            'jenis_pembayaran' => 'required|in:Cash,Non Tunai',
            'keterangan' => 'nullable|string|max:255',
        ]);

        //check if validation fails
        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        //find Data Service by ID
        $pembayaran = Pembayaran::find($id);

        //create Data Service
        $pembayaran->update([
            'jumlah_biaya'      => $request->jumlah_biaya,
            'jenis_pembayaran'  => $request->jenis_pembayaran,
            'keterangan'        => $request->keterangan,
        ]);

        //return response
        return new PembayaranResource(true, 'Data pembayaran Berhasil Diubah!', $pembayaran);
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
        $pembayaran = Pembayaran::find($id);

        //delete Data Service
        $pembayaran->delete();
        //return response
        return new PembayaranResource(true, 'Data pembayaran Berhasil Dihapus!', null);
    }
}
