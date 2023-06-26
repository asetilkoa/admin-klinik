<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanRm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_pasien = ['961', '962', '963', '964', '965', '966', '967', '968', '969','970'];
        $id_penyakit = ['34', '35', '36', '37', '38', '39', '40'];

        for ($i = 0; $i < 5; $i++) {
            \App\Models\RiwayatPenyakit::create([
                'id_pasien' => $id_pasien[array_rand($id_pasien)],
                'id_penyakit' => $id_penyakit[array_rand($id_penyakit)],
            ]);
        }
    }
}
