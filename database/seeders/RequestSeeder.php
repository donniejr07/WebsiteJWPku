<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request;
use Carbon\Carbon;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requests = [
            [
                'nama' => 'John Doe',
                'email' => 'john@example.com',
                'telepon' => '081234567890',
                'layanan_id' => null,
                'pesan' => 'Saya membutuhkan website portfolio untuk menampilkan karya-karya saya sebagai desainer grafis.',
                'status' => 'requested',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'nama' => 'Jane Smith',
                'email' => 'jane@example.com',
                'telepon' => '081234567891',
                'layanan_id' => null,
                'pesan' => 'Perusahaan kami memerlukan website company profile yang profesional dan modern.',
                'status' => 'approved',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'nama' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'telepon' => '081234567892',
                'layanan_id' => null,
                'pesan' => 'Saya ingin membuat landing page untuk produk baru yang akan diluncurkan.',
                'status' => 'requested',
                'created_at' => Carbon::now()->subHours(6),
                'updated_at' => Carbon::now()->subHours(6),
            ],
            [
                'nama' => 'Alice Brown',
                'email' => 'alice@example.com',
                'telepon' => '081234567893',
                'layanan_id' => null,
                'pesan' => 'Butuh website portfolio untuk fotografer dengan galeri yang menarik.',
                'status' => 'rejected',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($requests as $request) {
            Request::create($request);
        }
    }
}
