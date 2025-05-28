<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user1@example.com')->first();

        Client::create([
            'user_id' => $user->id,
            'name' => 'Client One',
            'email' => 'client1@example.com',
            'contact' => '0123456789',
        ]);

        Client::create([
            'user_id' => $user->id,
            'name' => 'Client Two',
            'email' => 'client2@example.com',
            'contact' => '0987654321',
        ]);
    }
}
