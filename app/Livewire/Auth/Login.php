<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    public $username, $password;
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Silakan masukkan username Anda.',
            'password.required' => 'Silakan masukkan password Anda.',
        ]);

        $throttleKey = strtolower($this->username) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->dispatch('play-error-sound');
            $this->dispatch('show-alert', [
                'title' => 'Ups!',
                'message' => 'Terlalu banyak percobaan. Coba lagi dalam '
                    . RateLimiter::availableIn($throttleKey) . ' detik.',
                'type' => 'error'
            ]);
            return null;
        }

        if (
            Auth::attempt([
                'username' => $this->username,
                'password' => $this->password
            ])
        ) {
            session()->regenerate();
            RateLimiter::clear($throttleKey);
            return redirect()->intended('/');
        }

        RateLimiter::hit($throttleKey, 60);
        $this->dispatch('play-error-sound');

        $this->dispatch('show-alert', [
            'title' => 'Ups!',
            'message' => 'Username atau password tidak sesuai.',
            'type' => 'error'
        ]);
    }
}
