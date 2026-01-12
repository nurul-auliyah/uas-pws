<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasMahasiswaController extends Controller
{
    // GET: semua data kelas_mahasiswa
    public function index()
    {
        $data = DB::table('kelas_mahasiswa')->get();

        return response()->json([
            'code' => 200,
            'message' => 'Get all kelas mahasiswa success',
            'data' => $data
        ]);
    }

    // POST: tambah data kelas_mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|integer',
            'mahasiswa_id' => 'required|integer'
        ]);

        DB::table('kelas_mahasiswa')->insert([
            'kelas_id' => $request->kelas_id,
            'mahasiswa_id' => $request->mahasiswa_id
        ]);

        return response()->json([
            'code' => 201,
            'message' => 'Kelas mahasiswa created successfully'
        ]);
    }

    // GET: detail kelas_mahasiswa
    public function show($id)
    {
        $data = DB::table('kelas_mahasiswa')
            ->where('kelas_mahasiswa_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Get detail kelas mahasiswa success',
            'data' => $data
        ]);
    }

    // PUT: update data
    public function update(Request $request, $id)
    {
        $data = DB::table('kelas_mahasiswa')
            ->where('kelas_mahasiswa_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        }

        DB::table('kelas_mahasiswa')
            ->where('kelas_mahasiswa_id', $id)
            ->update([
                'kelas_id' => $request->kelas_id ?? $data->kelas_id,
                'mahasiswa_id' => $request->mahasiswa_id ?? $data->mahasiswa_id
            ]);

        return response()->json([
            'code' => 200,
            'message' => 'Kelas mahasiswa updated successfully'
        ]);
    }

    // DELETE: hapus data
    public function destroy($id)
    {
        $data = DB::table('kelas_mahasiswa')
            ->where('kelas_mahasiswa_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        }

        DB::table('kelas_mahasiswa')
            ->where('kelas_mahasiswa_id', $id)
            ->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Kelas mahasiswa deleted successfully'
        ]);
    }
}
