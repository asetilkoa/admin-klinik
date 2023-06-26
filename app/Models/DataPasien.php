<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Utils\Aes;

class DataPasien extends Model
{
    use HasFactory;

    protected $table = 'dtpasien';

    protected $fillable = [
        'Nomor_Reg',
        'Nama_Lengkap',
        'Jenis_Identitas',
        'Nomor_Identitas',
        'Gender',
        'Agama',
        'Alamat',
        'Nomor_Hp',
        'Jaminan_Kesehatan',
        'Nomor_Jamkes',
        'Golongan_Darah',
        'Tanggal_Lahir',
    ];

    static function mount()
    {
        $aes = new Aes();
        $now = Carbon::now();
        $thnBUlan = $now->year . $now->month;
        $pasien = DataPasien::count();
        if ($pasien == 0) {
            $urut = 10000001;
            $nomer = 'RM' . $thnBUlan . $urut;
        } else {
            $ambil = DataPasien::all()->last();
            Log::debug($ambil);
            $urut = (int) substr( $aes->dekripAes($ambil->Nomor_Reg), -8) + 1;
            $nomer = 'RM' . $thnBUlan . $urut;
        }
       return $nomer;
    }

}
