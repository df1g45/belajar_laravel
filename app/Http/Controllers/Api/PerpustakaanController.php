<?php

namespace App\Http\Controllers\Api;

use App\Models\Perpustakaan;
use App\Http\Controllers\Controller;
use App\Http\Resources\PerpustakaanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerpustakaanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $perpustakaans = Perpustakaan::paginate(10);
        // return PerpustakaanResource::collection($perpustakaan);
        return new PerpustakaanResource(true, 'List Data Perpustakaan', $perpustakaans);
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

        //return response
        return new PerpustakaanResource(true, 'Data perpustakaan Berhasil Ditambahkan!', $perpustakaan);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find perpustakaan by ID
        $perpustakaan = Perpustakaan::find($id);

        //return response
        return new PerpustakaanResource(true, 'Detail Data perpustakaan!', $perpustakaan);
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

        
        //return response
        return new PerpustakaanResource(true, 'Data perpustakaan Berhasil Diubah!', $perpustakaan);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find perpustakaan by ID
        $perpustakaan = Perpustakaan::find($id);

        //delete perpustakaan
        $perpustakaan->delete();
        //return response
        return new PerpustakaanResource(true, 'Data perpustakaan Berhasil Dihapus!', null);
    }
}
