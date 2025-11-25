<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPegawai extends Model
{
    protected $table = 'kontak_pegawai';
    protected $fillable = ['nip','mobile_phone','no_link_aja'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}