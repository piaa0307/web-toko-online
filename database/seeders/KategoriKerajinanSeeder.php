<?php

namespace Database\Seeders;

use App\Models\KategoriKerajinan;
use Illuminate\Database\Seeder;

class KategoriKerajinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriKerajinan::create([
            'nama' => 'Serat Alam',
            'deskripsi' => 'Hasil kerajinan tangan menggunakan bahan dari serat alami.',
        ]);

        KategoriKerajinan::create([
            'nama' => 'Daur Ulang',
            'deskripsi' => 'Hasil kerajinan tangan yang menggunakan bahan yang dapat didaur ulang.',
        ]);

        KategoriKerajinan::create([
            'nama' => 'Tembikar',
            'deskripsi' => 'Hasil kerajinan tangan yang menggunakan tanah liat.',
        ]);
    }
}
