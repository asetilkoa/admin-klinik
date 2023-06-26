<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Utils\Aes;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $aes = new Aes();
        $faker = \Faker\Factory::create('id_ID');
        $jenisIdentitas = ['Ktp', 'Sim', 'Paspor'];
        $gender = ['Laki-Laki', 'Perempuan'];
        $golonganDarah = ['A', 'B', 'O', 'AB'];
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Khong Hu Cu'];
        $jaminanKesehatan = ['Umum', 'BPJS', 'PBI', 'Non PBI'];

        for ($i = 0; $i < 10; $i++) {
            \App\Models\DataPasien::create([
                'Nomor_Reg' => $aes->enkripAes(\App\Models\DataPasien::mount()),
                'Nama_Lengkap' => $aes->enkripAes($faker->name),
                'Jenis_Identitas' => $aes->enkripAes($jenisIdentitas[array_rand($jenisIdentitas)]),
                'Nomor_Identitas' => $aes->enkripAes($faker->nik),
                'Gender' => $aes->enkripAes($gender[array_rand($gender)]),
                'Agama' => $aes->enkripAes($agama[array_rand($agama)]),
                'Alamat' => $aes->enkripAes($faker->address),
                'Nomor_Hp' => $aes->enkripAes($faker->phoneNumber),
                'Jaminan_Kesehatan' => $aes->enkripAes($jaminanKesehatan[array_rand($jaminanKesehatan)]),
                'Nomor_Jamkes' => $aes->enkripAes($faker->nik),
                'Golongan_Darah' => $aes->enkripAes($golonganDarah[array_rand($golonganDarah)]),
                'Tanggal_Lahir' => $aes->enkripAes($faker->date('Y-m-d')),
            ]);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
