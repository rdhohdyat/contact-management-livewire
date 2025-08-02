<?php

use App\Livewire\Dashboard;
use App\Livewire\Error\NotFound;
use App\Livewire\Profile;
use App\Livewire\Contact\CreateContact;
use App\Livewire\Contact\EditContact;
use App\Livewire\Contact\DetailContact;
use App\Livewire\Address\CreateAddress;
use App\Livewire\Address\EditAddress;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

use App\Livewire\Test;
use Illuminate\Support\Facades\Route;

// 🔐 Routes yang hanya bisa diakses oleh user yang login
Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');

    // Contact
    Route::get('contact/create', CreateContact::class)->name('create-contact');
    Route::get('contact/{id}/edit', EditContact::class)->name('edit-contact');
    Route::get('contact/{id}/detail', DetailContact::class)->name('detail-contact');

    // Address
    Route::get('contact/{contactId}/address/create', CreateAddress::class)->name('create-address');
    Route::get('contact/{contactId}/address/{addressId}/edit', EditAddress::class)->name('edit-address');
});

Route::get('/test', Test::class)->name('login');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// 🔴 Fallback route (404)
Route::fallback(NotFound::class);
