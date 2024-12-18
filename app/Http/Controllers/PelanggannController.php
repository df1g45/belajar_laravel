<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pelanggann;

class PelanggannController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggann::paginate(10);
        return view('servisMotor.pelanggan.index', ['pelanggans' => $pelanggans]);
    }

    public function create()
    {
        return view('servisMotor.pelanggan.create');
    }

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

        return redirect(route('pelanggann.index'))->with('success', 'Pelanggan berhasil disimpan!');
    }
    public function edit($id)
    {
        //find pelanggan by ID
        $pelanggan = Pelanggann::find($id);
        return view('servisMotor.pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

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

        return redirect(route('pelanggann.index'))->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        //find pelanggan by ID
        $pelanggan = Pelanggann::find($id);

        //delete pelanggan
        $pelanggan->delete();

        return redirect(route('pelanggann.index'))->with('success', 'Deleted!');
    }
}
