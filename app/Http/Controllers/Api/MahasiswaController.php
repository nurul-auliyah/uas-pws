<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // GET ALL
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Mahasiswa::all()
        ]);
    }

    // GET BY ID
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama_mahasiswa' => 'required',
            'email' => 'required|email|unique:mahasiswa,email',
            'prodi' => 'required',
            'angkatan' => 'required|digits:4'
        ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id,
            'nama_mahasiswa' => 'required',
            'email' => 'required|email|unique:mahasiswa,email,' . $id,
            'prodi' => 'required',
            'angkatan' => 'required|digits:4'
        ]);

        $mahasiswa->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil diupdate',
            'data' => $mahasiswa
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil dihapus'
        ]);
    }
}
