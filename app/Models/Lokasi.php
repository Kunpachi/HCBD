<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $primaryKey = 'kode_lokasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_lokasi','nama_lokasi','country'];

    public function positions()
    {
        return $this->hasMany(Positions::class, 'location_code', 'kode_lokasi');
    }
}