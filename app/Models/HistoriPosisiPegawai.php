<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class HistoriPosisiPegawai extends Model
{
    protected $table = 'histori_posisi_pegawai';

    protected $fillable = [
        'nip',
        'position_code',
        'atasan_nip',
        'nama_atasan',
        'start_date_posisi',
        'end_date_posisi',
    ];

    protected $casts = [
        'start_date_posisi' => 'date',
        'end_date_posisi'   => 'date',
    ];

    public function pegawai()  { return $this->belongsTo(Pegawai::class, 'nip', 'nip'); }
    public function position() { return $this->belongsTo(Positions::class, 'position_code', 'position_code'); }
    public function superior() { return $this->belongsTo(Pegawai::class, 'atasan_nip', 'nip'); }

    protected function masaPosisi(): Attribute
    {
        return Attribute::get(function (): ?float {
            if (!$this->start_date_posisi) return null;
            $start = $this->start_date_posisi instanceof Carbon ? $this->start_date_posisi : Carbon::parse($this->start_date_posisi);
            $end   = $this->end_date_posisi instanceof Carbon ? $this->end_date_posisi : ($this->end_date_posisi ? Carbon::parse($this->end_date_posisi) : Carbon::now());
            $days  = $start->diffInDays($end);
            return round($days / 365.2425, 2);
        });
    }

    public function scopeCurrent($query)
    {
        return $query->whereNull('end_date_posisi');
    }
}