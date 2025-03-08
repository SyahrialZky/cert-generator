<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participants')->insert([
            [
                'nama' => 'John Doe',
                'email' => 'john.doe@example.com',
                'event_id' => 1,
                'sebagai' => 'Peserta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'event_id' => 2,
                'sebagai' => 'Pembicara',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'event_id' => 3,
                'sebagai' => 'Moderator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
