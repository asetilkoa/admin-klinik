<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyakit extends Model
{
    use HasFactory;
    protected $table = 'riwayat_penyakit';
    protected $guarded = [];

//     public function pasien()
//     {
//         return $this->belongsTo(DataPasien::class, 'id_pasien');
//     }

//     public function penyakit()
//     {
//         return $this->belongsTo(penyakit::class);
//     }
}
