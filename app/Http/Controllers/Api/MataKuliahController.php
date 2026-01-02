<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    // GET ALL
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => MataKuliah::all()
        ]);
    }

    // GET BY ID
    public function show($id)
    {
        $mk = MataKuliah::find($id);

        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mk
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'prodi' => 'required'
        ]);

        $mk = MataKuliah::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil ditambahkan',
            'data' => $mk
        ], 201);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mk = MataKuliah::find($id);

        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk,' . $id,
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'prodi' => 'required'
        ]);

        $mk->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil diupdate',
            'data' => $mk
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $mk = MataKuliah::find($id);

        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        $mk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil dihapus'
        ]);
    }
}
