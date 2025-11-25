<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndukUnit extends Model
{
    protected $table = 'induk_units';
    
    protected $primaryKey = 'kode_induk';
    
    public $incrementing = false;
    
    protected $keyType = 'string';
    
    protected $fillable = [
        'kode_induk',
        'nama_induk',
    ];
}