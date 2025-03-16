<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ParticipantImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Lewati baris pertama (header)
    }

    public function model(array $row)
    {
        if (empty(trim($row[0] ?? '')) || empty(trim($row[1] ?? '')) || empty(trim($row[2] ?? '')) || empty(trim($row[3] ?? ''))) {
            return null;
        }

        return new Participant([
            'nama'     => trim($row[0] ?? ''),
            'email'    => trim($row[1] ?? ''),
            'event_id' => trim($row[2] ?? ''),
            'sebagai'  => trim($row[3] ?? ''),
        ]);
    }
}
