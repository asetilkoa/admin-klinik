<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

}
