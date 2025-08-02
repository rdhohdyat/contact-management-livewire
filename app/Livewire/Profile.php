<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name, $password, $confirm_password;
    protected $listeners = [
        'triggerUpdateProfile' => 'updateProfile',
        'triggerUpdatePassword' => 'updatePassword'
    ];

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
    }
    public function render()
    {
        return view('livewire.profile');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Gunakan nama yang valid',
            'name.max' => 'Nama Harus kecil dari 100 karakter'
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->save();

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Profile berhasil diupdate.',
            'type' => 'success',
        ]);

        $this->dispatch('play-success-sound');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'password.required' => 'Silakan buat password Anda.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',

            'confirm_password.required' => 'Konfirmasi password Anda.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password yang Anda buat.',
        ]);

        $user = Auth::user();

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Password berhasil diganti.',
            'type' => 'success',
        ]);

        $this->dispatch('play-success-sound');
    }
}
