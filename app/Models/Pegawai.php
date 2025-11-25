<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip','full_name','status_kepegawaian','contract_type','angkatan','gender','religion',
        'marital_status','ptkp','birth_place','birth_date','blood_type','usia_pensiun','join_date',
        'email_corporate','user_ad','nik','disability_flag','disability_type','cif','global_transfer_flag'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date'  => 'date',
        'disability_flag' => 'boolean',
        'global_transfer_flag' => 'boolean',
    ];

    public function age(): Attribute {
        return Attribute::get(fn() => $this->birth_date ? Carbon::parse($this->birth_date)->age : null);
    }

    public function masaKerja(): Attribute {
        return Attribute::get(fn() => $this->join_date
            ? round(Carbon::parse($this->join_date)->floatDiffInYears(Carbon::now()), 2)
            : null);
    }

    public function contacts()             { return $this->hasMany(KontakPegawai::class, 'nip', 'nip'); }
    public function positionHistories()    { return $this->hasMany(HistoriPosisiPegawai::class, 'nip', 'nip'); }
    public function currentPositionHistory(){ return $this->hasOne(HistoriPosisiPegawai::class, 'nip', 'nip')->whereNull('end_date_posisi')->latest('start_date_posisi'); }
    public function gradeHistories()       { return $this->hasMany(HistoriGradePegawai::class, 'nip', 'nip'); }
    public function currentGrade()         { return $this->hasOne(HistoriGradePegawai::class, 'nip', 'nip')->whereNull('end_date_grade'); }
    public function educations()           { return $this->hasMany(PendidikanPegawai::class, 'nip', 'nip'); }
    public function performances()         { return $this->hasMany(PerformaPegawai::class, 'nip', 'nip'); }
    public function identifiers()          { return $this->hasMany(EmployeeIdentifier::class, 'nip', 'nip'); }
    public function assignments()          { return $this->hasMany(EmployeeAssignment::class, 'nip', 'nip'); }
}