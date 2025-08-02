<?php

namespace App\Livewire\Contact;

use App\Service\ContactService;
use Livewire\Component;

class CreateContact extends Component
{
    public $first_name, $last_name, $email, $phone;

    protected array $rules = [
        'first_name' => 'required|min:3',
        'email' => 'required|email',
        'last_name' => 'nullable|string',
        'phone' => 'nullable|string|max:20',
    ];

    protected array $messages = [
        'first_name.required' => 'Nama depan wajib diisi',
        'first_name.min' => 'Nama depan minimal 3 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'phone.max' => 'Nomor telepon maksimal 20 karakter',
    ];

    public function submit(ContactService $contactService)
    {
        $validated = $this->validate();

        $contactService->create($validated);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Kontak berhasil ditambahkan.',
            'type' => 'success',
            'redirect' => route('dashboard'),
        ]);

        $this->dispatch('play-success-sound');
    }

    public function render()
    {
        return view('livewire.contact.create-contact');
    }
}
