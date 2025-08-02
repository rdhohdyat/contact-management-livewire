<?php
namespace App\Service;

use App\Models\Address;

class AddressService
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function create(int $contactId, array $data): Address
    {
        $contact = $this->contactService->getByIdForCurrentUser($contactId);

        return Address::create([
            'contact_id' => $contact->id,
            'street' => $data['street'] ?? null,
            'city' => $data['city'] ?? null,
            'province' => $data['province'] ?? null,
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
        ]);
    }

    public function update(int $addressId, int $contactId, array $data)
    {
        $address = $this->getAddressForContact($addressId, $contactId);

        $address->update([
            'contact_id' => $contactId,
            'street' => $data['street'] ?? null,
            'city' => $data['city'] ?? null,
            'province' => $data['province'] ?? null,
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
        ]);
    }

    public function delete(int $addressId, int $contactId)
    {
        $address = $this->getAddressForContact($addressId, $contactId);

        $address->delete();
    }

    public function getAddressForContact(int $addressId, int $contactId): Address
    {
        return Address::where('id', $addressId)
            ->where('contact_id', $contactId)
            ->firstOrFail();
    }
}