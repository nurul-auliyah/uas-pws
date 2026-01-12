<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'fakultas_id';

    protected $fillable = [
        'fakultas_code',
        'fakultas_name'
    ];

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'fakultas_id', 'fakultas_id');
    }
}
