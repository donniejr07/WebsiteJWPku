<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;
use Carbon\Carbon;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'nama_layanan' => 'Website Portfolio',
                'nama_katalog' => 'Portfolio Profesional',
                'deskripsi' => 'Pembuatan website portfolio untuk menampilkan karya dan prestasi Anda dengan desain yang menarik dan profesional.',
                'harga' => 2500000.00,
                'kategori' => 'Website',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Company Profile',
                'nama_katalog' => 'Profil Perusahaan',
                'deskripsi' => 'Website company profile yang menampilkan informasi lengkap tentang perusahaan, visi misi, dan layanan yang ditawarkan.',
                'harga' => 5000000.00,
                'kategori' => 'Website',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Landing Page',
                'nama_katalog' => 'Halaman Pendaratan',
                'deskripsi' => 'Pembuatan landing page yang efektif untuk promosi produk atau layanan dengan fokus pada konversi.',
                'harga' => 1500000.00,
                'kategori' => 'Website',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'E-Commerce',
                'nama_katalog' => 'Toko Online',
                'deskripsi' => 'Website e-commerce lengkap dengan sistem pembayaran, manajemen produk, dan dashboard admin.',
                'harga' => 10000000.00,
                'kategori' => 'Website',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_layanan' => 'Aplikasi Mobile',
                'nama_katalog' => 'Aplikasi Seluler',
                'deskripsi' => 'Pengembangan aplikasi mobile untuk Android dan iOS dengan fitur yang disesuaikan dengan kebutuhan bisnis.',
                'harga' => 15000000.00,
                'kategori' => 'Mobile App',
                'gambar' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($layanan as $item) {
            Layanan::create($item);
        }
    }
}