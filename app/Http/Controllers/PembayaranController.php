<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\DaftarServis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    
    public function index()
    {
        $pembayarans = Pembayaran::with('daftarServis')->paginate(10);
        return view('servisMotor.pembayaran.index', ['pembayarans' => $pembayarans]);
    }

    public function create()
    {
        $daftarServis =  DaftarServis::all(); // Ambil semua data pelanggan

        return view('servisMotor.pembayaran.create', ['daftarServices' => $daftarServis]);
    }

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

        return redirect(route('pembayaran.index'))->with('success', 'Data pembayaran berhasil disimpan!');
    }

    public function edit($id)
    {
        $daftarServices =  DaftarServis::all(); // Ambil semua data pelanggan
        //find Data pembayaran by ID
        $pembayaran = Pembayaran::with(['daftarServis'])->find($id);

        return view('servisMotor.pembayaran.edit', compact('daftarServices', 'pembayaran'));
    }


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

        return redirect(route('pembayaran.index'))->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        //find Data Service by ID
        $pembayaran = Pembayaran::find($id);

        //delete Data Service
        $pembayaran->delete();

        return redirect(route('pembayaran.index'))->with('success', 'Deleted!');
    }
}
