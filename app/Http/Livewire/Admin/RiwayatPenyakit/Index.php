<?php

namespace App\Http\Livewire\Admin\RiwayatPenyakit;

use Livewire\Component;
use App\Models\penyakit;
use App\Models\DataPasien;
use App\Models\RiwayatPenyakit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $currentStep = 1, $totalStep = 2;
    public $halamanpas, $no_rekam_medik, $nama_pasien, $no_ktp, $alamat;
    public $pasiens = [], $penyakits = [];


    public function mount()
    {
        $this->currentStep = 1;
        $this->pasiens = DataPasien::all()->sortBy("id");
        $this->penyakits = penyakit::all()->sortBy("id");
    }

    public function incraseStep()
    {
        // $this->resetErrorBag();
        // $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalStep) {
            $this->currentStep = $this->totalStep;
        }
    }

    public function decraseStep()
    {
    //     $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
        $this->dispatchBrowserEvent('refresh-page');
    }

    public function ResetAll()
    {
        $this->dispatchBrowserEvent('refresh-page');
    }

    public function halamanpas ()
    {
        return redirect()->to('/admin/DataPasien');
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('livewire.admin.riwayat-penyakit.index')
        ->extends('layouts.admin')
        ->section('content');

    }
}
