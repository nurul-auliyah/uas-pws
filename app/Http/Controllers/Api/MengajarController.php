<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MengajarController extends Controller
{
    // GET semua mengajar
    public function index()
    {
        $data = DB::table('mengajar')->get();

        return response()->json([
            'code' => 200,
            'message' => 'Get all mengajar success',
            'data' => $data
        ]);
    }

    // POST tambah mengajar
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|integer',
            'dosen_id' => 'required|integer'
        ]);

        DB::table('mengajar')->insert([
            'kelas_id' => $request->kelas_id,
            'dosen_id' => $request->dosen_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'code' => 201,
            'message' => 'Mengajar created successfully'
        ]);
    }

    // GET detail mengajar
    public function show($id)
    {
        $data = DB::table('mengajar')
            ->where('mengajar_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Mengajar not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Get detail mengajar success',
            'data' => $data
        ]);
    }

    // PUT update mengajar
    public function update(Request $request, $id)
    {
        $data = DB::table('mengajar')
            ->where('mengajar_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Mengajar not found'
            ]);
        }

        DB::table('mengajar')
            ->where('mengajar_id', $id)
            ->update([
                'kelas_id' => $request->kelas_id ?? $data->kelas_id,
                'dosen_id' => $request->dosen_id ?? $data->dosen_id,
                'updated_at' => now()
            ]);

        return response()->json([
            'code' => 200,
            'message' => 'Mengajar updated successfully'
        ]);
    }

    // DELETE hapus mengajar
    public function destroy($id)
    {
        $data = DB::table('mengajar')
            ->where('mengajar_id', $id)
            ->first();

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Mengajar not found'
            ]);
        }

        DB::table('mengajar')
            ->where('mengajar_id', $id)
            ->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Mengajar deleted successfully'
        ]);
    }
}
