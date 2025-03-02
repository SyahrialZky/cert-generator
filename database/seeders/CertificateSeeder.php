<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::insert([
            [
                'recipient_name' => 'John Doe',
                'certificate_number' => Str::random(10),
                'event_name' => 'Pelatihan Dasar Pemrograman Web',
                'issued_date' => now()->subDays(30),
                'expiry_date' => now()->addYears(1),
                'template_id' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipient_name' => 'Jane Smith',
                'certificate_number' => Str::random(10),
                'event_name' => 'Seminar Internasional Teknologi Masa Depan',
                'issued_date' => now()->subDays(15),
                'expiry_date' => null,
                'template_id' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipient_name' => 'Alice Johnson',
                'certificate_number' => Str::random(10),
                'event_name' => 'Workshop Coding Laravel Tingkat Lanjut',
                'issued_date' => now()->subDays(7),
                'expiry_date' => null,
                'template_id' => 3,
                'status' => 'revoked',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
