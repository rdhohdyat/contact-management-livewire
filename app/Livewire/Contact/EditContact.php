<?php

namespace App\Livewire\Contact;

use App\Models\Contact;
use App\Service\ContactService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditContact extends Component
{
    public $contactId;

    public $first_name, $last_name, $email, $phone;
    protected $listeners = ['triggerSubmitEdit' => 'submit'];

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


    public function mount($id, ContactService $service)
    {
        $this->contactId = $id;

        $contact = $service->getByIdForCurrentUser($id);

        $this->fill($contact->only($contact->getFillable()));
    }

    public function submit(ContactService $service)
    {
        $validated = $this->validate();

        $service->update($this->contactId, $validated);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Kontak berhasil diperbarui.',
            'type' => 'success',
            'redirect' => route('detail-contact', ['id' => $this->contactId]),
        ]);
        $this->dispatch('play-success-sound');
    }

    public function render()
    {
        return view('livewire.contact.edit-contact');
    }
}
