<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class MahasiswaController extends Controller
{
    // public function __construct() {

    // }

    public function show()
    {
        $mahasiswa = Mahasiswa::with('MataKuliah')->get();
        return response()->json([
            'success' => 'sukses',
            'message' => 'semua data berhasil ditampilkan',
            'mahasiswa' =>$mahasiswa
        ], 200);
    }

    public function getUserById(Request $request)
    {

        $nim = $request->nim;
        $mahasiswa = mahasiswa::find($nim);

        return response()->json([
            'mahasiswa' => $mahasiswa,
            'prodi' => $mahasiswa->prodi,
            'matakuliah' => $mahasiswa->matakuliah
        ]);
    }

    public function getByToken(Request $request)
    {
        $user = $request->user;
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'token salah'
            ], 400);
        }
        return response()->json([
            'status' => 'sukses',
            'message' => 'haloo ' . $user->nama,
            'mahasiswa' => $user
        ], 200);
    }

    public function addMataKuliahtoMhs($nim, Request $request)
    {
        $mahasiswa = Mahasiswa::find($nim);

        $mahasiswa->MataKuliah()->attach($request->id);

        return response()->json([
            'status' => 'sukses',
            'message' => 'Mata kuliah telah ditambahkan untuk mahasiswa' . $mahasiswa->name,
            'mahasiswa' => $mahasiswa->nim
        ]);
    }



    public function deleteUser(Request $request)
    {
        $user = Mahasiswa::find($request);
        $user->delete();

        return response()->json([
            'status' => 'sukses',
            'message' => 'Data Mahasiswa Telah Dihapus',
        ], 200);
    }


    public function deleteMk(Request $request)
    {
        $user = Mahasiswa::find($request->nim);
        $user->MataKuliah()->detach($request->id);

        return response()->json([
            'status' => 'sukses',
            'message' => 'Data Mahasiswa - Mata Kuliah Telah Dihapus',
        ], 200);
    }
}
