<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // 215150709111006
    // Daffa Raka Mahendra

    protected $primaryKey = 'nim';
    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'password',
        'token'
    ];
    protected $hidden = [];


    public function MataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah','mhsNim','mkId') ?? 'Kosong';
    }
}
