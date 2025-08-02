<?php

namespace App\Livewire\Address;

use App\Service\AddressService;
use App\Service\ContactService;
use Livewire\Component;

class CreateAddress extends Component
{
    public $contactId;
    public $contact;

    public $street, $city, $province, $country, $postal_code;
    protected array $rules = [
        'street' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:100',
        'province' => 'nullable|string|max:100',
        'country' => 'required|string|max:100',
        'postal_code' => 'required|string|max:10',
    ];
    protected array $messages = [
        'country.required' => 'Negara wajib diisi.',
        'postal_code.required' => 'Kode pos wajib diisi.',
    ];

    public function mount($contactId, ContactService $contactService)
    {
        $this->contactId = $contactId;
        $this->contact = $contactService->getByIdForCurrentUser($contactId);
    }
    public function submit(AddressService $addressService)
    {
        $validated = $this->validate();

        $addressService->create($this->contactId, $validated);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Alamat berhasil ditambahkan.',
            'type' => 'success',
            'redirect' => route('detail-contact', ['id' => $this->contactId]),
        ]);

        $this->dispatch('play-success-sound');
    }

    public function render()
    {
        return view('livewire.address.create-address');
    }
}
