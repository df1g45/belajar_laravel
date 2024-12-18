<?php

namespace App\Http\Controllers;

use App\Models\DaftarServis;
use App\Models\Pelanggann;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaftarServisController extends Controller
{

    public function index()
    {
        $daftarServices = DaftarServis::with(['kendaraan', 'pelanggan'])->paginate(10);
        return view('servisMotor.daftarServis.index', ['daftarServices' => $daftarServices]);
    }

    public function create()
    {
        $pelanggans = Pelanggann::all(); // Ambil semua data pelanggan
        $kendaraans = Kendaraan::all(); // Ambil semua data kendaraan

        return view('servisMotor.daftarServis.create', compact('pelanggans', 'kendaraans'));
    }

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
        return redirect(route('daftarServis.index'))->with('success', 'Daftar Servis berhasil disimpan!');
    }

    public function edit($id)
    {
        $pelanggans = Pelanggann::all(); // Ambil semua data pelanggan
        $kendaraans = Kendaraan::all(); // Ambil semua data kendaraan
        //find Daftar Service by ID
        $daftarService = DaftarServis::with(['kendaraan', 'pelanggan'])->find($id);

        return view('servisMotor.daftarServis.edit', compact('pelanggans', 'kendaraans', 'daftarService'));
    }


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

        return redirect(route('daftarServis.index'))->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        //find Daftar Service by ID
        $daftarService = DaftarServis::find($id);

        //delete Daftar Service
        $daftarService->delete();

        return redirect(route('daftarServis.index'))->with('success', 'Deleted!');
    }
}
