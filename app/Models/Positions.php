<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    protected $table = 'positions';
    protected $primaryKey = 'position_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'position_code','position_name','department_code','cost_center_code',
        'directorate_code','location_code','job_code'
    ];

    public function department()    { return $this->belongsTo(Department::class, 'department_code','kode_department'); }
    public function costCenter()    { return $this->belongsTo(CostCenter::class, 'cost_center_code','kode_cost_center'); }
    public function directorate()   { return $this->belongsTo(Direktorat::class, 'directorate_code','kode_direktorat'); }
    public function location()      { return $this->belongsTo(Lokasi::class, 'location_code','kode_lokasi'); }
    public function job()           { return $this->belongsTo(Pekerjaan::class, 'job_code','job_code'); }

    public function positionHistories()
    {
        return $this->hasMany(HistoriPosisiPegawai::class, 'position_code', 'position_code');
    }
}