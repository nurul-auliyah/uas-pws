<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // 🔹 GET ALL STUDENTS
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Student::with('prodi')->get()
        ]);
    }

    // 🔹 CREATE STUDENT
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students,nis',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:students,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $student = Student::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Student berhasil ditambahkan',
            'data' => $student
        ], 201);
    }

    // 🔹 GET STUDENT BY ID
    public function show($id)
    {
        $student = Student::with('prodi')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $student
        ]);
    }

    // 🔹 UPDATE STUDENT
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students,nis,' . $id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:students,email,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $student->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Student berhasil diupdate',
            'data' => $student
        ]);
    }

    // 🔹 DELETE STUDENT
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student tidak ditemukan'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student berhasil dihapus'
        ]);
    }

    // 🔹 GET STUDENTS BY PRODI
    public function byProdi($prodi_id)
    {
        Prodi::findOrFail($prodi_id);

        return response()->json([
            'success' => true,
            'data' => Student::where('prodi_id', $prodi_id)->get()
        ]);
    }
}
