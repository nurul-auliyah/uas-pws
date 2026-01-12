<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'prodi_id';

    protected $fillable = [
        'fakultas_id',
        'prodi_code',
        'prodi_name'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'fakultas_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'prodi_id', 'prodi_id');
    }
}
