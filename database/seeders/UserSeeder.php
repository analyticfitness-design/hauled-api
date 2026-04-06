<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name"     => "Admin HAULED",
            "email"    => "admin@hauled.co",
            "password" => Hash::make("admin1234"),
            "role"     => "admin",
            "phone"    => "3000000000",
        ]);

        User::create([
            "name"     => "Cliente Demo",
            "email"    => "cliente@hauled.co",
            "password" => Hash::make("cliente1234"),
            "role"     => "user",
            "phone"    => "3111111111",
        ]);
    }
}
