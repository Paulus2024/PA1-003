<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jabatan; // Import model Jabatan

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatanList = [
            ['nama_jabatan' => 'Kepala Desa', 'deskripsi_jabatan' => 'Pemimpin tertinggi di desa.'],
            ['nama_jabatan' => 'Sekretaris', 'deskripsi_jabatan' => 'Membantu kepala desa dalam administrasi pemerintahan.'],
            ['nama_jabatan' => 'Kasi Pelayanan 1', 'deskripsi_jabatan' => 'Kepala seksi yang bertugas dalam pelayanan masyarakat.'],
            ['nama_jabatan' => 'Kasi Pelayanan 2', 'deskripsi_jabatan' => 'Kepala seksi yang bertugas dalam pelayanan masyarakat.'],
            ['nama_jabatan' => 'Kasi Pelayanan 3', 'deskripsi_jabatan' => 'Kepala seksi yang bertugas dalam pelayanan masyarakat.'],
            ['nama_jabatan' => 'Kasi Kesejahteraan', 'deskripsi_jabatan' => 'Kepala seksi yang menangani bidang kesejahteraan sosial desa.'],
            ['nama_jabatan' => 'Kaur Keuangan', 'deskripsi_jabatan' => 'Kepala urusan yang bertanggung jawab dalam pengelolaan keuangan desa.'],
            ['nama_jabatan' => 'Kaur Tata Usaha/Umum', 'deskripsi_jabatan' => 'Kepala urusan yang menangani administrasi tata usaha dan umum.'],
            ['nama_jabatan' => 'Kaur Perencanaan', 'deskripsi_jabatan' => 'Kepala urusan yang bertanggung jawab dalam perencanaan pembangunan desa.'],
            ['nama_jabatan' => 'Kadus 1', 'deskripsi_jabatan' => 'Kepala dusun wilayah 1.'],
            ['nama_jabatan' => 'Kadus 2', 'deskripsi_jabatan' => 'Kepala dusun wilayah 2.'],
            ['nama_jabatan' => 'Kadus 3', 'deskripsi_jabatan' => 'Kepala dusun wilayah 3.'],
        ];

        foreach ($jabatanList as $jabatan) {
            Jabatan::firstOrCreate(
                ['nama_jabatan' => $jabatan['nama_jabatan']],
                ['deskripsi_jabatan' => $jabatan['deskripsi_jabatan']]
            );
        }
    }
}
