<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'kode_department';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_department','nama_department','rumpun_divisi','parent_department'];

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_department', 'kode_department');
    }

    public function children()
    {
        return $this->hasMany(Department::class, 'parent_department', 'kode_department');
    }

    public function positions()
    {
        return $this->hasMany(Positions::class, 'department_code', 'kode_department');
    }
}