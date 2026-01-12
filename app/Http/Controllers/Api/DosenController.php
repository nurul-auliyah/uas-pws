<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    // GET ALL DOSEN
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Dosen::all()
        ]);
    }

    // GET DOSEN BY ID
    public function show($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dosen
        ]);
    }

    // CREATE DOSEN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama_dosen' => 'required',
            'email' => 'required|email',
            'prodi' => 'required'
        ]);

        $dosen = Dosen::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil ditambahkan',
            'data' => $dosen
        ], 201);
    }

    // UPDATE DOSEN
    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nidn' => 'required|unique:dosen,nidn,' . $id,
            'nama_dosen' => 'required',
            'email' => 'required|email',
            'prodi' => 'required'
        ]);

        $dosen->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil diupdate',
            'data' => $dosen
        ]);
    }

    // DELETE DOSEN
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        $dosen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil dihapus'
        ]);
    }
}
