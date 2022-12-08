<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{


    public function getAll()
    {
        $mataKuliah = MataKuliah::with('Mahasiswa')->get();
        return response()->json([
            'status' => 'sukses',
            'message' => 'Data Mata Kuliah ditampilkan',
            'matakuliah' => $mataKuliah ,
        ],200);
    }

    public function addMataKuliah(Request $request)
    {
        $matakuliah = MataKuliah::create(
            [
                'nama' => $request->nama,
            ]
        );

        return response()->json([
            'status' => 'sukses',
            'message' => 'Mata Kuliah baru telah ditambahkan',
            'matakuliah' => $matakuliah
        ]);
    }

    public function getMataKuliahById(Request $request)
    {
        $mataKuliah = MataKuliah::findOrFail($request->id);

        return response()->json([
            'status'=>'sukses',
            'message'=> 'Mata kuliah ditemukan',
            'mata_kuliah' => $mataKuliah
        ]);
    }

}
