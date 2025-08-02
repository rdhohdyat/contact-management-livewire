<?php

namespace App\Service;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function create(array $data): Contact
    {
        return Contact::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'username' => Auth::user()->username,
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $contact = Contact::where('id', $id)
            ->where('username', Auth::user()->username)
            ->firstOrFail();

        return $contact->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'username' => Auth::user()->username,
        ]);
    }

    public function delete(int $id): void
    {
        $contact = $this->getByIdForCurrentUser($id);

        DB::transaction(function () use ($contact) {
            $contact->addresses()->delete();
            $contact->delete();
        });
    }

    public function getByIdForCurrentUser(int $id): Contact
    {
        return Contact::where('id', $id)
            ->where('username', Auth::user()->username)
            ->firstOrFail();
    }
}