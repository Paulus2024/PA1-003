<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BumdesSeeder extends Seeder
{
    public function run(): void
    {
        $existing = User::where('email', 'bumdes@gmail.com')->first();

        if (!$existing) {
            User::create([
                'name' => 'Bumdes',
                'email' => 'bumdes@gmail.com',
                'password' => Hash::make('admin123'),
                // 'phone' => '081234567890',
                // 'address' => 'Jl. Contoh Alamat No. 123',
                'usertype' => 'bumdes',
            ]);
        } else {
            $existing->update([
                'name' => 'Bumdes (Diperbarui)',
                'password' => Hash::make('passwordbaru'),
            ]);
        }
    }
}
