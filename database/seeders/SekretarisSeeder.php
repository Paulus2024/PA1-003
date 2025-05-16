<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SekretarisSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kita tidak membuat duplikat berdasarkan email
        $existing = User::where('email', 'sekretaris@gmail.com')->first();

        if (!$existing) {
            // Buat user dengan semua kolom yang ada di $fillable
            User::create([
                'name' => 'Sekretaris Utama',  // Nilai yang sesuai
                'email' => 'sekretaris@gmail.com', // Nilai yang sesuai
                'password' => Hash::make('admin123'), // Nilai yang sesuai (enkripsi!)
                'usertype' => 'sekretaris', // Nilai yang sesuai
            ]);
        } else {
            // Opsi: Perbarui user yang sudah ada
            $existing->update([
                'name' => 'Sekretaris Utama (Diperbarui)',
                'password' => Hash::make('passwordbaru'),
            ]);
        }
    }
}
