<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'username' => 'adminuser',
            'password' => bcrypt('password'),
            'name' => 'Admin User',
        ]);

        Contact::factory(15)->create([
            'username' => $user->username,
        ])->each(function ($contact) {
            Address::factory(4)->create([
                'contact_id' => $contact->id,
            ]);
        });
    }
}
