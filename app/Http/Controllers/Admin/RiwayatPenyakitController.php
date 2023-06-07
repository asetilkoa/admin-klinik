<?php

namespace App\Http\Controllers\Admin;

use App\Models\penyakit;
use App\Models\DataPasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Utils\Aes;
use App\Http\Requests\PenyakitRequest;
use App\Models\RiwayatPenyakit;

class RiwayatPenyakitController extends Controller
{
    public function getDetailRiwayat(Request $request){
        $aes = new Aes();
        $pasien = DataPasien::find($request->id);
        $data = [
            'id'=> $pasien?->id,
            'Nomor_Reg'=> $pasien?->Nomor_Reg,
            'Nama_Lengkap'=>$pasien?->Nama_Lengkap,
            'Nomor_Identitas'=> $aes->dekripAes($pasien?->Nomor_Identitas),
            'Alamat' => $aes->dekripAes($pasien?->Alamat),
        ];
        return response()->json([
            'pasien'=> $data
        ]);
    }

    public function store(Request $request)
    {
        if(empty($request->cbpasien)){
            return response()->json([
                'message' => "Checklist Salah Satu"
            ]);
        }

        # get id penyakit
        foreach($request->cbpasien as $c){
            RiwayatPenyakit::create([
                'id_penyakit' => $c,
                'id_pasien' => $request->id_pasien
            ]);
        }

        return response()->json([
            'message' => "Berhasil input riwayat penyakit"
        ]);
    }
}
