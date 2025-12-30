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
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => Prodi::with('fakultas')->findOrFail($id)
        ]);
    }

    // 🔹 UPDATE ALL (PUT)
    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,fakultas_id',
            'prodi_code'  => 'required|unique:prodi,prodi_code,' . $prodi->prodi_id . ',prodi_id',
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
    public function patch(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'fakultas_id' => 'sometimes|exists:fakultas,fakultas_id',
            'prodi_code'  => 'sometimes|unique:prodi,prodi_code,' . $prodi->prodi_id . ',prodi_id',
            'prodi_name'  => 'sometimes'
        ]);

        $prodi->update($request->only([
            'fakultas_id',
            'prodi_code',
            'prodi_name'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil diperbarui sebagian',
            'data' => $prodi
        ]);
    }

    // 🔹 DELETE PRODI
    public function destroy($id)
    {
        Prodi::findOrFail($id)->delete();

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
