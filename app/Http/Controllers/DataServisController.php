<?php

namespace App\Http\Controllers;

use App\Models\DataServis;
use App\Models\DaftarServis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataServisController extends Controller
{
    public function index()
    {
        $dataServis = DataServis::with('daftarServis')->paginate(10);
        return view('servisMotor.listServis.index', ['services' => $dataServis]);
    }

    public function create()
    {
        $daftarServis =  DaftarServis::all(); // Ambil semua data pelanggan

        return view('servisMotor.listServis.create', ['daftarServices' => $daftarServis]);
    }

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

        return redirect(route('dataServis.index'))->with('success', 'Data Servis berhasil disimpan!');
    }

    public function edit($id)
    {
        $daftarServices =  DaftarServis::all(); // Ambil semua data pelanggan
        //find Data Service by ID
        $service = DataServis::with(['daftarServis'])->find($id);
        //return response
        return view('servisMotor.listServis.edit', compact('daftarServices', 'service'));
    }

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

        return redirect(route('dataServis.index'))->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        //find Data Service by ID
        $dataService = DataServis::find($id);

        //delete Data Service
        $dataService->delete();
        return redirect(route('dataServis.index'))->with('success', 'Deleted!');
    }
}
