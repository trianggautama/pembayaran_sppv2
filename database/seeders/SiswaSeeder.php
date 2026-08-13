<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswaData = [
            // Kelas 1A (kelas_id akan di-resolve)
            ['nis' => '2024001', 'nama' => 'Aulia Putri', 'kelas' => '1A', 'nama_wali' => 'Hendra Wijaya', 'telepon' => '081345678901'],
            ['nis' => '2024002', 'nama' => 'Farel Aditya', 'kelas' => '1A', 'nama_wali' => 'Sugianto', 'telepon' => '081234561001'],
            ['nis' => '2024003', 'nama' => 'Zahra Amelia', 'kelas' => '1A', 'nama_wali' => 'Mulyadi', 'telepon' => '081234561002'],
            ['nis' => '2024004', 'nama' => 'Raffi Anggara', 'kelas' => '1A', 'nama_wali' => 'Suparman', 'telepon' => '081234561003'],
            ['nis' => '2024005', 'nama' => 'Salsabila Azzahra', 'kelas' => '1A', 'nama_wali' => 'Eko Prasetyo', 'telepon' => '081234561004'],
            ['nis' => '2024006', 'nama' => 'Alif Rahman', 'kelas' => '1A', 'nama_wali' => 'Bambang Irawan', 'telepon' => '081234561005'],

            // Kelas 2A
            ['nis' => '2024007', 'nama' => 'Raka Pratama', 'kelas' => '2A', 'nama_wali' => 'Siti Rahayu', 'telepon' => '081298765432'],
            ['nis' => '2024008', 'nama' => 'Nadia Safitri', 'kelas' => '2A', 'nama_wali' => 'Suroto', 'telepon' => '081234562001'],
            ['nis' => '2024009', 'nama' => 'Rizky Maulana', 'kelas' => '2A', 'nama_wali' => 'Wahyudi', 'telepon' => '081234562002'],
            ['nis' => '2024010', 'nama' => 'Aisyah Putri', 'kelas' => '2A', 'nama_wali' => 'Sutrisno', 'telepon' => '081234562003'],
            ['nis' => '2024011', 'nama' => 'Bima Sakti', 'kelas' => '2A', 'nama_wali' => 'Hariyanto', 'telepon' => '081234562004'],
            ['nis' => '2024012', 'nama' => 'Citra Dewi', 'kelas' => '2A', 'nama_wali' => 'Suryadi', 'telepon' => '081234562005'],

            // Kelas 2B
            ['nis' => '2024013', 'nama' => 'Dani Firmansyah', 'kelas' => '2B', 'nama_wali' => 'Agung Prabowo', 'telepon' => '081234562101'],
            ['nis' => '2024014', 'nama' => 'Elsa Maharani', 'kelas' => '2B', 'nama_wali' => 'Suyanto', 'telepon' => '081234562102'],
            ['nis' => '2024015', 'nama' => 'Galih Prayoga', 'kelas' => '2B', 'nama_wali' => 'Mardianto', 'telepon' => '081234562103'],
            ['nis' => '2024016', 'nama' => 'Hasna Khairunnisa', 'kelas' => '2B', 'nama_wali' => 'Rudi Hermawan', 'telepon' => '081234562104'],
            ['nis' => '2024017', 'nama' => 'Ilham Kurniawan', 'kelas' => '2B', 'nama_wali' => 'Teguh Santoso', 'telepon' => '081234562105'],
            ['nis' => '2024018', 'nama' => 'Jasmine Olivia', 'kelas' => '2B', 'nama_wali' => 'Widodo', 'telepon' => '081234562106'],
            ['nis' => '2024019', 'nama' => 'Kevin Saputra', 'kelas' => '2B', 'nama_wali' => 'Slamet Riyadi', 'telepon' => '081234562107'],

            // Kelas 3A
            ['nis' => '2024020', 'nama' => 'Luthfi Hakim', 'kelas' => '3A', 'nama_wali' => 'Joko Widodo', 'telepon' => '081234563001'],
            ['nis' => '2024021', 'nama' => 'Mira Handayani', 'kelas' => '3A', 'nama_wali' => 'Sugeng Raharjo', 'telepon' => '081234563002'],
            ['nis' => '2024022', 'nama' => 'Naufal Hanif', 'kelas' => '3A', 'nama_wali' => 'Darmawan', 'telepon' => '081234563003'],
            ['nis' => '2024023', 'nama' => 'Olivia Sari', 'kelas' => '3A', 'nama_wali' => 'Purnomo', 'telepon' => '081234563004'],
            ['nis' => '2024024', 'nama' => 'Putra Ramadhan', 'kelas' => '3A', 'nama_wali' => 'Yusuf Maulana', 'telepon' => '081234563005'],
            ['nis' => '2024025', 'nama' => 'Qiana Ramadhani', 'kelas' => '3A', 'nama_wali' => 'Wahyu Nugroho', 'telepon' => '081234563006'],

            // Kelas 3C
            ['nis' => '2024026', 'nama' => 'Dimas Saputra', 'kelas' => '3C', 'nama_wali' => 'Dewi Lestari', 'telepon' => '087856781234'],
            ['nis' => '2024027', 'nama' => 'Rini Wulandari', 'kelas' => '3C', 'nama_wali' => 'Sumardi', 'telepon' => '081234563101'],
            ['nis' => '2024028', 'nama' => 'Satria Budi', 'kelas' => '3C', 'nama_wali' => 'Haryanto', 'telepon' => '081234563102'],
            ['nis' => '2024029', 'nama' => 'Tiara Puspitasari', 'kelas' => '3C', 'nama_wali' => 'Gunawan', 'telepon' => '081234563103'],
            ['nis' => '2024030', 'nama' => 'Umar Faruq', 'kelas' => '3C', 'nama_wali' => 'Syamsul Arifin', 'telepon' => '081234563104'],
            ['nis' => '2024031', 'nama' => 'Vina Melati', 'kelas' => '3C', 'nama_wali' => 'Rusmanto', 'telepon' => '081234563105'],

            // Kelas 4A
            ['nis' => '2024032', 'nama' => 'Keisha Anindya', 'kelas' => '4A', 'nama_wali' => 'Budi Santoso', 'telepon' => '081234567890'],
            ['nis' => '2024033', 'nama' => 'Wira Kusuma', 'kelas' => '4A', 'nama_wali' => 'Puji Hartono', 'telepon' => '081234564001'],
            ['nis' => '2024034', 'nama' => 'Xena Aurelia', 'kelas' => '4A', 'nama_wali' => 'Sudirman', 'telepon' => '081234564002'],
            ['nis' => '2024035', 'nama' => 'Yoga Pratama', 'kelas' => '4A', 'nama_wali' => 'Supriyadi', 'telepon' => '081234564003'],
            ['nis' => '2024036', 'nama' => 'Zara Adelia', 'kelas' => '4A', 'nama_wali' => 'Mujiyanto', 'telepon' => '081234564004'],
            ['nis' => '2024037', 'nama' => 'Andi Wijaya', 'kelas' => '4A', 'nama_wali' => 'Basuki Rahmat', 'telepon' => '081234564005'],
            ['nis' => '2024038', 'nama' => 'Bunga Citra', 'kelas' => '4A', 'nama_wali' => 'Kusno Adi', 'telepon' => '081234564006'],

            // Kelas 5A
            ['nis' => '2024039', 'nama' => 'Cahya Nugraha', 'kelas' => '5A', 'nama_wali' => 'Poniman', 'telepon' => '081234565001'],
            ['nis' => '2024040', 'nama' => 'Dinda Permata', 'kelas' => '5A', 'nama_wali' => 'Sarjono', 'telepon' => '081234565002'],
            ['nis' => '2024041', 'nama' => 'Evan Maulidi', 'kelas' => '5A', 'nama_wali' => 'Taufik Hidayat', 'telepon' => '081234565003'],
            ['nis' => '2024042', 'nama' => 'Fitria Rahmawati', 'kelas' => '5A', 'nama_wali' => 'Mulyono', 'telepon' => '081234565004'],
            ['nis' => '2024043', 'nama' => 'Gilang Ramadhan', 'kelas' => '5A', 'nama_wali' => 'Suprapto', 'telepon' => '081234565005'],
            ['nis' => '2024044', 'nama' => 'Hana Safira', 'kelas' => '5A', 'nama_wali' => 'Karno Wibowo', 'telepon' => '081234565006'],

            // Kelas 6A
            ['nis' => '2024045', 'nama' => 'Naila Fitri', 'kelas' => '6A', 'nama_wali' => 'Ahmad Fauzi', 'telepon' => '085612345678'],
            ['nis' => '2024046', 'nama' => 'Irfan Habibi', 'kelas' => '6A', 'nama_wali' => 'Sunaryo', 'telepon' => '081234566001'],
            ['nis' => '2024047', 'nama' => 'Julia Anggraeni', 'kelas' => '6A', 'nama_wali' => 'Partono', 'telepon' => '081234566002'],
            ['nis' => '2024048', 'nama' => 'Khairi Akbar', 'kelas' => '6A', 'nama_wali' => 'Miyanto', 'telepon' => '081234566003'],
            ['nis' => '2024049', 'nama' => 'Layla Azzura', 'kelas' => '6A', 'nama_wali' => 'Suharno', 'telepon' => '081234566004'],
            ['nis' => '2024050', 'nama' => 'Mahesa Putra', 'kelas' => '6A', 'nama_wali' => 'Djoko Susanto', 'telepon' => '081234566005'],
        ];

        // Map nama_kelas → id
        $kelasMap = Kelas::pluck('id', 'nama_kelas');

        foreach ($siswaData as $i => $data) {
            $no = str_pad($i + 1, 2, '0', STR_PAD_LEFT);

            $user = User::create([
                'name' => $data['nama_wali'],
                'username' => 'wali' . $no,
                'email' => 'wali' . $no . '@spp-sukamaju.test',
                'password' => bcrypt('password'),
                'role' => 'wali_siswa',
            ]);

            Siswa::create([
                'nis' => $data['nis'],
                'nama' => $data['nama'],
                'kelas_id' => $kelasMap[$data['kelas']],
                'nama_wali' => $data['nama_wali'],
                'telepon_wali' => $data['telepon'],
                'user_id' => $user->id,
            ]);
        }
    }
}
