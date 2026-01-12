<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FakultasController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Fakultas::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas_code' => 'required|unique:fakultas,fakultas_code',
            'fakultas_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $fakultas = Fakultas::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Fakultas berhasil ditambahkan',
            'data' => $fakultas
        ], 201);
    }

    public function show($fakultas_id)
    {
        $fakultas = Fakultas::find($fakultas_id);

        if (!$fakultas) {
            return response()->json([
                'success' => false,
                'message' => 'Fakultas tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $fakultas
        ]);
    }

    public function update(Request $request, $fakultas_id)
    {
        $fakultas = Fakultas::find($fakultas_id);

        if (!$fakultas) {
            return response()->json([
                'success' => false,
                'message' => 'Fakultas tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'fakultas_code' => 'required|unique:fakultas,fakultas_code,' . $fakultas_id . ',fakultas_id',
            'fakultas_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $fakultas->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Fakultas berhasil diperbarui',
            'data' => $fakultas
        ]);
    }

    public function destroy($fakultas_id)
    {
        $fakultas = Fakultas::find($fakultas_id);

        if (!$fakultas) {
            return response()->json([
                'success' => false,
                'message' => 'Fakultas tidak ditemukan'
            ], 404);
        }

        $fakultas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Fakultas berhasil dihapus'
        ]);
    }
}
