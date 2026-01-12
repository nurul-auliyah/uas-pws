<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    // GET: semua kelas
    public function index()
    {
        $kelas = DB::table('kelas')->get();

        return response()->json([
            'code' => 200,
            'message' => 'Get all kelas success',
            'data' => $kelas
        ]);
    }

    // POST: tambah kelas
    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|integer',
            'mata_kuliah_id' => 'required|integer',
            'kelas_code' => 'required|string|unique:kelas,kelas_code',
            'kelas_name' => 'required|string'
        ]);

        DB::table('kelas')->insert([
            'prodi_id' => $request->prodi_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kelas_code' => $request->kelas_code,
            'kelas_name' => $request->kelas_name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'code' => 201,
            'message' => 'Kelas created successfully'
        ]);
    }

    // GET: detail kelas
    public function show($id)
    {
        $kelas = DB::table('kelas')->where('kelas_id', $id)->first();

        if (!$kelas) {
            return response()->json([
                'code' => 404,
                'message' => 'Kelas not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Get detail kelas success',
            'data' => $kelas
        ]);
    }

    // PUT: update kelas
    public function update(Request $request, $id)
    {
        $kelas = DB::table('kelas')->where('kelas_id', $id)->first();

        if (!$kelas) {
            return response()->json([
                'code' => 404,
                'message' => 'Kelas not found'
            ]);
        }

        DB::table('kelas')
            ->where('kelas_id', $id)
            ->update([
                'prodi_id' => $request->prodi_id ?? $kelas->prodi_id,
                'mata_kuliah_id' => $request->mata_kuliah_id ?? $kelas->mata_kuliah_id,
                'kelas_code' => $request->kelas_code ?? $kelas->kelas_code,
                'kelas_name' => $request->kelas_name ?? $kelas->kelas_name,
                'updated_at' => now()
            ]);

        return response()->json([
            'code' => 200,
            'message' => 'Kelas updated successfully'
        ]);
    }

    // DELETE: hapus kelas
    public function destroy($id)
    {
        $kelas = DB::table('kelas')->where('kelas_id', $id)->first();

        if (!$kelas) {
            return response()->json([
                'code' => 404,
                'message' => 'Kelas not found'
            ]);
        }

        DB::table('kelas')->where('kelas_id', $id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Kelas deleted successfully'
        ]);
    }
}
