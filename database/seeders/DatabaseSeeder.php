<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Sekolah',
            'username' => 'admin',
            'role' => 'admin',
            'email' => 'admin@spp-sukamaju.test',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Bendahara Sekolah',
            'username' => 'bendahara',
            'role' => 'bendahara',
            'email' => 'bendahara@spp-sukamaju.test',
            'password' => bcrypt('password'),
        ]);

        \App\Models\TahunAjaran::create([
            'nama' => '2024/2025',
            'semester' => 1,
            'is_active' => false,
            'tanggal_mulai' => '2024-07-15',
            'tanggal_selesai' => '2024-12-20',
        ]);
        \App\Models\TahunAjaran::create([
            'nama' => '2024/2025',
            'semester' => 2,
            'is_active' => false,
            'tanggal_mulai' => '2025-01-06',
            'tanggal_selesai' => '2025-06-20',
        ]);
        \App\Models\TahunAjaran::create([
            'nama' => '2025/2026',
            'semester' => 1,
            'is_active' => true,
            'tanggal_mulai' => '2025-07-14',
            'tanggal_selesai' => '2025-12-19',
        ]);
        \App\Models\TahunAjaran::create([
            'nama' => '2025/2026',
            'semester' => 2,
            'is_active' => false,
            'tanggal_mulai' => '2026-01-05',
            'tanggal_selesai' => '2026-06-19',
        ]);

        // \App\Models\Kelas::create(['nama_kelas' => '1A', 'tingkat' => 1, 'wali_kelas' => 'Ibu Sri Wahyuni']);
        // \App\Models\Kelas::create(['nama_kelas' => '2A', 'tingkat' => 2, 'wali_kelas' => 'Bapak Agus Riyanto']);
        // \App\Models\Kelas::create(['nama_kelas' => '2B', 'tingkat' => 2, 'wali_kelas' => 'Ibu Ratna Sari']);
        // \App\Models\Kelas::create(['nama_kelas' => '3A', 'tingkat' => 3, 'wali_kelas' => 'Bapak Joko Susilo']);
        // \App\Models\Kelas::create(['nama_kelas' => '3C', 'tingkat' => 3, 'wali_kelas' => 'Ibu Nurul Hidayah']);
        // \App\Models\Kelas::create(['nama_kelas' => '4A', 'tingkat' => 4, 'wali_kelas' => 'Bapak Dedi Kurniawan']);
        // \App\Models\Kelas::create(['nama_kelas' => '5A', 'tingkat' => 5, 'wali_kelas' => 'Ibu Mega Puspita']);
        // \App\Models\Kelas::create(['nama_kelas' => '6A', 'tingkat' => 6, 'wali_kelas' => 'Bapak Rudi Hartono']);

        // $this->call(SiswaSeeder::class);
    }
}
