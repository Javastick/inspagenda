<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\InviteMail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => 'lalala123',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => 'lalala123',
            'role' => 'user',
        ]);
        InviteMail::create([
            'sender' => 'inspektorat Daerah',
        'masuk' => '2025-02-12',
        'hari' =>  '2025-02-13 10:30:00',
        'kegiatan' => 'Undangan Bintal',
        'tempat' => 'Kantor Inspektorat Daerah',
        'keterangan' => 'Pembahasan terkait bintal',//nullable
        ]);
        InviteMail::create([
            'sender' => 'Dinas Pendidikan',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-13 09:00:00',
            'kegiatan' => 'Rapat Koordinasi Pendidikan',
            'tempat' => 'Aula Dinas Pendidikan',
            'keterangan' => 'Pembahasan kurikulum baru',
        ]);
        
        InviteMail::create([
            'sender' => 'Badan Kepegawaian Daerah',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-14 14:00:00',
            'kegiatan' => 'Sosialisasi Peraturan Kepegawaian',
            'tempat' => 'Gedung Serba Guna',
            'keterangan' => 'Penjelasan regulasi baru bagi ASN',
        ]);
        
        InviteMail::create([
            'sender' => 'Dinas Kesehatan',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-15 08:30:00',
            'kegiatan' => 'Seminar Kesehatan Masyarakat',
            'tempat' => 'Hotel Grand Brebes',
            'keterangan' => 'Diskusi kesehatan preventif',
        ]);
        
        InviteMail::create([
            'sender' => 'Bappeda',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-16 10:00:00',
            'kegiatan' => 'Penyusunan Rencana Pembangunan',
            'tempat' => 'Ruang Rapat Bappeda',
            'keterangan' => 'Strategi pembangunan daerah',
        ]);
        
        InviteMail::create([
            'sender' => 'KPU Kabupaten',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-17 13:30:00',
            'kegiatan' => 'Rapat Persiapan Pemilu',
            'tempat' => 'Kantor KPU',
            'keterangan' => null,
        ]);
        
        InviteMail::create([
            'sender' => 'Dinas Pariwisata',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-18 15:00:00',
            'kegiatan' => 'Workshop Pengembangan Wisata',
            'tempat' => 'Gedung Wisata',
            'keterangan' => 'Strategi meningkatkan kunjungan',
        ]);
        
        InviteMail::create([
            'sender' => 'Badan Penanggulangan Bencana Daerah',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-19 09:00:00',
            'kegiatan' => 'Simulasi Tanggap Darurat',
            'tempat' => 'Lapangan BPBD',
            'keterangan' => 'Pelatihan mitigasi bencana',
        ]);
        
        InviteMail::create([
            'sender' => 'Dinas Sosial',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-20 11:00:00',
            'kegiatan' => 'Diskusi Program Bantuan Sosial',
            'tempat' => 'Kantor Dinsos',
            'keterangan' => null,
        ]);
        
        InviteMail::create([
            'sender' => 'Polres Brebes',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-21 08:00:00',
            'kegiatan' => 'Pemaparan Keamanan Daerah',
            'tempat' => 'Markas Polres',
            'keterangan' => 'Evaluasi keamanan wilayah',
        ]);
        
        InviteMail::create([
            'sender' => 'DPRD Kabupaten',
            'masuk' => '2025-02-12',
            'hari' => '2025-02-22 14:30:00',
            'kegiatan' => 'Rapat Legislasi Daerah',
            'tempat' => 'Gedung DPRD',
            'keterangan' => 'Pembahasan rancangan peraturan daerah',
        ]);
        
    }
}
