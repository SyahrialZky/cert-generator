<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Template::insert([
            [
                'name' => 'Template Sertifikat Pelatihan Dasar',
                'file_path' => 'templates/pelatihan_dasar.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template Sertifikat Seminar Internasional',
                'file_path' => 'templates/seminar_internasional.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template Sertifikat Workshop Coding',
                'file_path' => 'templates/workshop_coding.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
