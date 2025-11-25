<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformaPegawai extends Model
{
    protected $table = 'performa_pegawai';

    protected $fillable = [
        'nip','year','score_type','score_value'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip','nip');
    }

    public function scopeYear($q, $year)
    {
        return $q->where('year', $year);
    }
}