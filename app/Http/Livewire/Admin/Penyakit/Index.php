<?php

namespace App\Http\Livewire\Admin\Penyakit;

use App\Models\penyakit;
use Livewire\Component;
use App\Utils\Aes;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $nama_penyakit, $penyakit_id, $perPage;
    public $search = '';
    protected $paginationTheme = 'bootstrap', $index = 0;

    public function rules()
    {
        return [
            'nama_penyakit' => 'required|string'
        ];
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->nama_penyakit = NULL;
    }

    public function addDtPenyakit()
    {
        $validatedData = $this->validate();
        $aes = new Aes();
        penyakit::create([
            'nama_penyakit' => $aes->enkripAes($this->nama_penyakit),
        ]);
        session()->flash('message', 'Data Pasien Telah Ditambah');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deletePenyakit($penyakit_id)
    {
        $this->penyakit_id = $penyakit_id;
    }

    public function destroyPenyakit()
    {
        penyakit::findOrFail($this->penyakit_id)->delete();
        session()->flash('message', 'Data Pasien Telah Dihapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $penyakits = penyakit::where('nama_penyakit', 'like', '%'.$this->search.'%')->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.penyakit.index', ['penyakits' => $penyakits])
        ->extends('layouts.admin')
        ->section('content');
    }
}
