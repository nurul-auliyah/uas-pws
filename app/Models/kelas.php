<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';

    protected $fillable = [
        'prodi_id',
        'mata_kuliah_id',
        'kelas_code',
        'kelas_name'
    ];
}
