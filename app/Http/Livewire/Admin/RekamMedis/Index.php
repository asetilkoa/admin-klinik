<?php

namespace App\Http\Livewire\Admin\RekamMedis;

use Livewire\Component;
use App\Models\RiwayatPenyakit;
use App\Models\penyakit;
use App\Models\DataPasien;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;
    public $penyakit,$riwyat_penyakit;
    public $search = '';

    public function showRM(int $pasien_id)
    {
        $pasien = RiwayatPenyakit::join('penyakit', 'penyakit.id', '=', 'riwayat_penyakit.id_penyakit')
        ->where('riwayat_penyakit.id_pasien', $pasien_id)
        ->get(['penyakit.id', 'penyakit.nama_penyakit']);
        $this->penyakit = $pasien;

    }

    public function deleteRm($riwyat_penyakit)
    {
        $this->riwyat_penyakit = $riwyat_penyakit;
    }

// menghapus data pada database
    public function destroyRM()
    {
        RiwayatPenyakit::where('id', $this->riwyat_penyakit)->delete();
        session()->flash('message', 'Data Pasien Telah Dihapus');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {

        $riwayatPenyakit = DataPasien::where('Nama_Lengkap', 'like', '%'.$this->search.'%')
        ->join('riwayat_penyakit', 'riwayat_penyakit.id_pasien', '=', 'dtpasien.id')
        ->orderBy('id', 'DESC')
        ->select(['dtpasien.id', 'dtpasien.Nama_Lengkap', 'dtpasien.Nomor_Reg'])
        ->distinct()
        ->paginate(5);

        return view('livewire.admin.rekam-medis.index', ['riwayatPenyakit' => $riwayatPenyakit])
        ->extends('layouts.admin')
        ->section('content');
    }
}
