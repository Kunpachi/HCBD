<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeIdentifier extends Model
{
    protected $table = 'employee_identifiers';

    protected $fillable = [
        'nip','no_dplk','no_bpjs_kesehatan','no_bpjs_ketenagakerjaan','effective_date'
    ];

    protected $casts = [
        'effective_date' => 'date'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip','nip');
    }
}