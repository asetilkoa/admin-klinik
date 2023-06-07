<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    public $name, $email, $password, $role, $user_id, $pasien_id;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'integer'],
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->role = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function addDtUser()
    {
        $validatedData = $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);
        session()->flash('message', 'Data Pasien Telah Ditambah');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function editUser(int $user_id)
    {
        $this->user_id = $user_id;
        $user = User::findOrFail($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role = $user->role;
    }

    public function updateUser()
    {
        $validatedData = $this->validate();
        User::findOrFail($this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ]);
        session()->flash('message', 'Data user Telah Diupdate');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteUser($user_id)
    {
        $this->user_id = $user_id;
    }

    public function destroyUser()
    {
        User::findOrFail($this->user_id)->delete();
        session()->flash('message', 'Data user Telah Dihapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $users = User::orderBy('id')->paginate(5);
        return view('livewire.admin.user.index', ['users' => $users])
        ->extends('layouts.admin')
        ->section('content');
    }
}
