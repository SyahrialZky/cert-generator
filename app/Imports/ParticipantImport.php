<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ParticipantImport implements ToModel, WithStartRow
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    public function startRow(): int
    {
        return 2; // Lewati baris pertama (header)
    }

    public function model(array $row)
    {
        if (empty(trim($row[0] ?? '')) || empty(trim($row[1] ?? '')) || empty(trim($row[2] ?? ''))) {
            return null;
        }

        return new Participant([
            'nama'     => trim($row[0] ?? ''),
            'email'    => trim($row[1] ?? ''),
            'event_id' => $this->event_id,
            'sebagai'  => trim($row[2] ?? ''),
        ]);
    }
}
