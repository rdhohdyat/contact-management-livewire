<?php

namespace App\Livewire\Contact;

use App\Models\Contact;
use App\Service\AddressService;
use App\Service\ContactService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailContact extends Component
{
    public $contactId;
    public $contact;

    public function mount($id, ContactService $contactService)
    {
        $this->contactId = $id;
        $this->contact = $contactService->getByIdForCurrentUser($id);
    }

    protected $listeners = ['deleteAddressTrigger' => 'deleteAddress'];
    public function deleteAddress($id, AddressService $addressService)
    {
        $addressService->delete($id, $this->contactId);

        $this->dispatch('show-alert', [
            'title' => 'Sukses!',
            'message' => 'Alamat berhasil dihapus.',
            'type' => 'success',
        ]);

        $this->dispatch('play-success-sound');
    }

    public function render()
    {
        return view('livewire.contact.detail-contact', [
            'contact' => $this->contact,
            'addresses' => $this->contact->addresses
        ]);
    }
}
