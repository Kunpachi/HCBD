<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direktorat extends Model
{
    protected $table = 'direktorat';
    protected $primaryKey = 'kode_direktorat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_direktorat','nama_direktorat'];

    public function positions()
    {
        return $this->hasMany(Positions::class, 'directorate_code', 'kode_direktorat');
    }
}