<?php

namespace App\Exports\InspectionExport;

use App\Exports\InspectionExport\Sheets\OfficeInspectionSheet;
use App\Exports\InspectionExport\Sheets\WorkshopInspectionSheet;
use App\Models\InspectionRecap;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InspectionExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct(protected InspectionRecap $inspectionRecap) {}

    public function sheets(): array
    {
        return [
            new InspectionSheet($this->inspectionRecap, '1'),
            new InspectionSheet($this->inspectionRecap, '2'),
        ];
    }
}
