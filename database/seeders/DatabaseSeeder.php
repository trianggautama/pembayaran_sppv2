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

        User::factory()->create([
            'name' => 'Budi Santoso',
            'username' => 'wali01',
            'role' => 'wali_siswa',
            'email' => 'wali01@spp-sukamaju.test',
            'password' => bcrypt('password'),
        ]);
    }
}
