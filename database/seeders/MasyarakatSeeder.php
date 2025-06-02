<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasyarakatSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kita tidak membuat duplikat berdasarkan email
        $existing = User::where('email', 'user@gmail.com')->first();

        if (!$existing) {
            // Buat user dengan semua kolom yang ada di $fillable
            User::create([
                'name' => 'User',  // Nilai yang sesuai
                'email' => 'user@gmail.com', // Nilai yang sesuai
                'password' => Hash::make('user123'), // Nilai yang sesuai (enkripsi!)
                'usertype' => 'user', // Nilai yang sesuai
            ]);
        } else {
            // Opsi: Perbarui user yang sudah ada
            $existing->update([
                'name' => 'user (Diperbarui)',
                'password' => Hash::make('passwordbaru'),
            ]);
        }
    }
}
