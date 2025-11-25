<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HistoriGradePegawai extends Model
{
    protected $table = 'histori_grade_pegawai';

    protected $fillable = ['nip','person_grade','start_date_grade','end_date_grade'];

    protected $casts = [
        'start_date_grade' => 'date',
        'end_date_grade'   => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip','nip');
    }

    public function getMasaGradeAttribute(): ?float
    {
        $end = $this->end_date_grade ?? Carbon::now();
        return $this->start_date_grade
            ? round(Carbon::parse($this->start_date_grade)->floatDiffInYears($end), 2)
            : null;
    }
}