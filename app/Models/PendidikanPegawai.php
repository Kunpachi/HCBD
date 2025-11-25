<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendidikanPegawai extends Model
{
    protected $table = 'pendidikan_pegawai';

    protected $fillable = [
        'nip','jenjang_code','tahun_lulus','institusi','fakultas','jurusan','ipk','country'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip','nip');
    }
}