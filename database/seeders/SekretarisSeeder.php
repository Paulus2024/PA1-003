<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SekretarisSeeder extends Seeder
{
    public function run(): void
    {
        $existing = User::where('email', 'sekretaris@gmail.com')->first();
        if (!$existing) {
            User::create([
                'name' => 'sekretaris',
                'email' => 'sekretaris@gmail.com',
                'password' => Hash::make('admin123'),
                'usertype' => 'sekretaris',
            ]);
        }
    }
}
