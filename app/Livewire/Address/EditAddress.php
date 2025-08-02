<?php

namespace App\Livewire\Address;

use App\Service\AddressService;
use App\Service\ContactService;
use Livewire\Component;

class EditAddress extends Component
{
    public $contactId, $addressId;
    public $contact;
    public $address;

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

    protected $listeners = ['triggerSubmitEdit' => 'submit'];

    public function mount(
        $contactId,$addressId, ContactService $contactService,AddressService $addressService
    ) {
        $this->contactId = $contactId;

        $this->addressId = $addressId;

        $this->contact = $contactService->getByIdForCurrentUser($contactId);

        $this->address = $addressService->getAddressForContact($addressId, $contactId);

        $this->fill($this->address->only($this->address->getFillable()));
    }

    public function submit(AddressService $addressService)
    {
        $validated = $this->validate();

        $addressService->update($this->addressId, $this->contactId, $validated);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Alamat berhasil diperbarui.',
            'type' => 'success',
            'redirect' => route(
                'detail-contact',
                ['id' => $this->contactId]
            ),
        ]);

        $this->dispatch('play-success-sound');
    }
    public function render()
    {
        return view('livewire.address.edit-address');
    }
}
