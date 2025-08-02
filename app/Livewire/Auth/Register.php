<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $name, $username, $password, $confirm_password;

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Silakan isi nama lengkap Anda.',
            'name.min' => 'Nama minimal harus terdiri dari 3 karakter.',

            'username.required' => 'Silakan buat username Anda.',
            'username.min' => 'Username minimal harus terdiri dari 3 karakter.',
            'username.unique' => 'Username ini sudah digunakan.',

            'password.required' => 'Silakan buat password Anda.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',

            'confirm_password.required' => 'Konfirmasi password Anda.',
            'confirm_password.same' => 'Konfirmasi password harus sama dengan password yang Anda buat.',
        ]);

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Yeay, akun anda berhasil didaftarkan, silahkan login',
            'type' => 'success',
            'redirect' => route('login')
        ]);
        $this->dispatch('play-success-sound');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
