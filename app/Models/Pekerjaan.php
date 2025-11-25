<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';
    protected $primaryKey = 'job_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'job_code','job_title','layer_job','job_family','rumpun_jabatan',
        'valid_grade_min','valid_grade_max','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function positions()
    {
        return $this->hasMany(Positions::class, 'job_code', 'job_code');
    }
}