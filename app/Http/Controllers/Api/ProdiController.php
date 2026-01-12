<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // 🔹 GET ALL PRODI
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Prodi::with('fakultas')->get()
        ]);
    }

    // 🔹 CREATE PRODI
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,fakultas_id',
            'prodi_code'  => 'required|unique:prodi,prodi_code',
            'prodi_name'  => 'required'
        ]);

        $prodi = Prodi::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil ditambahkan',
            'data' => $prodi
        ], 201);
    }

    // 🔹 GET PRODI BY ID
    public function show($prodi_id)
    {
        return response()->json([
            'success' => true,
            'data' => Prodi::with('fakultas')->findOrFail($prodi_id)
        ]);
    }

    // 🔹 UPDATE ALL (PUT)
    public function update(Request $request, $prodi_id)
    {
        $prodi = Prodi::findOrFail($prodi_id);

        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,fakultas_id',
            'prodi_code'  => 'required|unique:prodi,prodi_code,' . $prodi_id . ',prodi_id',
            'prodi_name'  => 'required'
        ]);

        $prodi->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil diupdate',
            'data' => $prodi
        ]);
    }

    // 🔹 UPDATE PARTIAL (PATCH)
    public function patch(Request $request, $prodi_id)
    {
        return $this->update($request, $prodi_id);
    }

    // 🔹 DELETE PRODI
    public function destroy($prodi_id)
    {
        Prodi::findOrFail($prodi_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil dihapus'
        ]);
    }

    // 🔹 GET PRODI BY FAKULTAS
    public function byFakultas($fakultas_id)
    {
        Fakultas::findOrFail($fakultas_id);

        return response()->json([
            'success' => true,
            'data' => Prodi::where('fakultas_id', $fakultas_id)->get()
        ]);
    }
}
