<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAssignment extends Model
{
    protected $table = 'employee_assignments';

    protected $fillable = [
        'nip','assignment_number','global_transfer_flag','start_date','end_date','description'
    ];

    protected $casts = [
        'global_transfer_flag' => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip','nip');
    }
}