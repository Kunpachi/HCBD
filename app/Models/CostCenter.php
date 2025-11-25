<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    protected $table = 'cost_centers';
    protected $primaryKey = 'kode_cost_center';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_cost_center','nama_cost_center'];

    public function positions()
    {
        return $this->hasMany(Positions::class, 'cost_center_code', 'kode_cost_center');
    }
}