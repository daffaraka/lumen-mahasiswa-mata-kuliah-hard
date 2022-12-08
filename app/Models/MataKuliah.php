<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    // 215150709111006
    // Daffa Raka Mahendra

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
    protected $hidden = [];


    public function Mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah','mkId','mhsNim') ?? 'Kosong';
    }
}
