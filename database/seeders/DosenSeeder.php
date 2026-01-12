<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create([
            'nidn'        => '0123456789',
            'nama_dosen'  => 'Dr. Budi Santoso',
            'email'       => 'budi@kampus.ac.id',
            'prodi'       => 'Teknik Informatika'
        ]);

        Dosen::create([
            'nidn'        => '9876543210',
            'nama_dosen'  => 'Siti Aminah, M.Kom',
            'email'       => 'siti@kampus.ac.id',
            'prodi'       => 'Sistem Informasi'
        ]);
    }
}
