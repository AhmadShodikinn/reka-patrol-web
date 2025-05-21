<?php

namespace App\Exports;

use App\Models\SafetyPatrol;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SafetyPatrolExport implements FromQuery, WithHeadings
{
    public function __construct(protected String $from_date, protected String $to_date) {}

    public function headings(): array
    {
        return [
            'No',
            'Temuan',
            'Lokasi',
            'Kategori',
            'Resiko',
            'Tanggal Pemeriksaan',
            'Tindak Lanjut',
        ];
    }
    public function query()
    {
        return SafetyPatrol::query()->selectRaw('ROW_NUMBER() OVER(ORDER BY created_at) as No, findings_description, location, category, risk, checkup_date, action_description')
            ->whereBetween('created_at', [$this->from_date, $this->to_date]);
    }
}
