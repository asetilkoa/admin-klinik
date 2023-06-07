<?php

namespace App\Http\Livewire\Admin\DataPasien;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DataPasien;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;
use App\Utils\Aes;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $Nomor_Reg, $Nama_Lengkap, $Jenis_Identitas, $Nomor_Identitas, $Gender, $Agama, $Alamat, $Nomor_Hp, $Jaminan_Kesehatan, $Nomor_Jamkes, $Golongan_Darah, $pasien_id, $Tanggal_Lahir;
    public $search = '';

    public function rules()
    {
        return [
            'Nomor_Reg' => 'required|string',
            'Nama_Lengkap' => 'required|string',
            'Jenis_Identitas' => 'required|string',
            'Nomor_Identitas' => 'required|numeric',
            'Gender' => 'required|string',
            'Agama' => 'required|string',
            'Alamat' => 'required|string',
            'Nomor_Hp' => 'required|numeric',
            'Jaminan_Kesehatan' => 'required|string',
            'Nomor_Jamkes' => 'required|numeric',
            'Golongan_Darah' => 'required|string',
            'Tanggal_Lahir' => 'required|string'
        ];
    }

// mengkosongkan input
    public function resetInput()
    {
        $this->Nomor_Reg = NULL;
        $this->Nama_Lengkap = NULL;
        $this->Jenis_Identitas = NULL;
        $this->Nomor_Identitas = NULL;
        $this->Gender = NULL;
        $this->Alamat = NULL;
        $this->Agama = NULL;
        $this->Nomor_Hp = NULL;
        $this->Jaminan_Kesehatan = NULL;
        $this->Nomor_Jamkes = NULL;
        $this->Golongan_Darah = NULL;
        $this->Tanggal_Lahir = NULL;
        $this->pasien_id = NULL;
    }

// input data ke database
    public function addDtPasien()
    {
        $validatedData = $this->validate();
        $aes = new Aes();
        DataPasien::create([
            'Nomor_Reg' => $this->Nomor_Reg,
            'Nama_Lengkap' => $this->Nama_Lengkap,
            'Jenis_Identitas' => $this->Jenis_Identitas,
            'Nomor_Identitas' => $aes->enkripAes($this->Nomor_Identitas),
            'Gender' => $aes->enkripAes($this->Gender),
            'Agama' => $aes->enkripAes($this->Agama),
            'Alamat' => $aes->enkripAes($this->Alamat),
            'Nomor_Hp' => $aes->enkripAes($this->Nomor_Hp),
            'Jaminan_Kesehatan' => $this->Jaminan_Kesehatan,
            'Nomor_Jamkes' => $aes->enkripAes($this->Nomor_Jamkes),
            'Golongan_Darah' => $aes->enkripAes($this->Golongan_Darah),
            'Tanggal_Lahir' => $aes->enkripAes($this->Tanggal_Lahir),
        ]);
        session()->flash('message', 'Data Pasien Telah Ditambah');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

// menempilkan data pada database
    public function editPasien(int $pasien_id)
    {
        $aes = new Aes();
        $this->pasien_id = $pasien_id;
        $pasien = DataPasien::findOrFail($pasien_id);
        $this->Nomor_Reg = $pasien->Nomor_Reg;
        $this->Nama_Lengkap = $pasien->Nama_Lengkap;
        $this->Jenis_Identitas = $pasien->Jenis_Identitas;
        $this->Nomor_Identitas = $aes->dekripAes($pasien->Nomor_Identitas);
        $this->Gender = $aes->dekripAes($pasien->Gender);
        $this->Alamat = $aes->dekripAes($pasien->Alamat);
        $this->Agama = $aes->dekripAes($pasien->Agama);
        $this->Nomor_Hp = $aes->dekripAes($pasien->Nomor_Hp);
        $this->Jaminan_Kesehatan = $pasien->Jaminan_Kesehatan;
        $this->Nomor_Jamkes = $aes->dekripAes($pasien->Nomor_Jamkes);
        $this->Golongan_Darah =$aes->dekripAes($pasien->Golongan_Darah);
        $this->Tanggal_Lahir = $aes->dekripAes($pasien->Tanggal_Lahir);
    }

// mengubah data pada database
    public function updateDtPasien()
    {
        $validatedData = $this->validate();
        $aes = new Aes();
        DataPasien::findOrFail($this->pasien_id)->update([
            'Nomor_Reg' => $this->Nomor_Reg,
            'Nama_Lengkap' => $this->Nama_Lengkap,
            'Jenis_Identitas' => $this->Jenis_Identitas,
            'Nomor_Identitas' => $aes->enkripAes($this->Nomor_Identitas),
            'Gender' => $aes->enkripAes($this->Gender),
            'Agama' => $aes->enkripAes($this->Agama),
            'Alamat' => $aes->enkripAes($this->Alamat),
            'Nomor_Hp' => $aes->enkripAes($this->Nomor_Hp),
            'Jaminan_Kesehatan' => $this->Jaminan_Kesehatan,
            'Nomor_Jamkes' => $aes->enkripAes($this->Nomor_Jamkes),
            'Golongan_Darah' => $aes->enkripAes($this->Golongan_Darah),
            'Tanggal_Lahir' => $aes->enkripAes($this->Tanggal_Lahir),
        ]);
        session()->flash('message', 'Data Pasien Telah Diupdate');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    //  delete data
    public function deletePasien($pasien_id)
    {
        $this->pasien_id = $pasien_id;
    }

// menghapus data pada database
    public function destroyPasien()
    {
        DataPasien::findOrFail($this->pasien_id)->delete();
        session()->flash('message', 'Data Pasien Telah Dihapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

// menempilkan data pada database
    public function showPasien(int $pasien_id)
    {
        $aes = new Aes();
        $this->pasien_id = $pasien_id;
        $pasien = DataPasien::findOrFail($pasien_id);
        $this->Nomor_Reg = $pasien->Nomor_Reg;
        $this->Nama_Lengkap = $pasien->Nama_Lengkap;
        $this->Jenis_Identitas = $pasien->Jenis_Identitas;
        $this->Nomor_Identitas = $aes->dekripAes($pasien->Nomor_Identitas);
        $this->Gender = $aes->dekripAes($pasien->Gender);
        $this->Alamat = $aes->dekripAes($pasien->Alamat);
        $this->Agama = $aes->dekripAes($pasien->Agama);
        $this->Nomor_Hp = $aes->dekripAes($pasien->Nomor_Hp);
        $this->Jaminan_Kesehatan = $pasien->Jaminan_Kesehatan;
        $this->Nomor_Jamkes = $aes->dekripAes($pasien->Nomor_Jamkes);
        $this->Golongan_Darah =$aes->dekripAes($pasien->Golongan_Darah);
        $this->Tanggal_Lahir = $aes->dekripAes($pasien->Tanggal_Lahir);
    }

// function untuk penomoran otomatis
    public function mount()
    {
        $now = Carbon::now();
        $thnBUlan = $now->year . $now->month;
        $pasien = DataPasien::count();
        if ($pasien == 0) {
            $urut = 10000001;
            $nomer = 'RM' . $thnBUlan . $urut;
        } else {
            $ambil = DataPasien::all()->last();
            $urut = (int) substr($ambil->Nomor_Reg, -8) + 1;
            $nomer = 'RM' . $thnBUlan . $urut;
        }
        $this->Nomor_Reg = $nomer;
    }

    public function render()
    {

        $pasiens = DataPasien::where('Nama_Lengkap', 'like', '%'.$this->search.'%')->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.data-pasien.index', ['pasiens' => $pasiens])
            ->extends('layouts.admin')
            ->section('content');
    }
}
