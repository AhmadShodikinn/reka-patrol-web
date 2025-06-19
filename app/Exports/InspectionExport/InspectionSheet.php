<?php

namespace App\Exports\InspectionExport;

use App\Models\Criteria;
use App\Models\Inspection;
use App\Models\InspectionRecap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InspectionSheet implements WithDrawings, WithStyles, WithTitle, WithMapping, FromCollection, WithCustomStartCell, WithColumnWidths
{
    use Exportable;

    private Collection $inspections;
    private array $criteriaTypeGroupRow;
    private array $inspectionRow;
    public function __construct(protected InspectionRecap $inspectionRecap, protected String $locationID) {
        $this->inspections = Inspection::whereBetween('created_at', [$this->inspectionRecap->from_date, $this->inspectionRecap->to_date])
                                ->whereIsValidEntry(true)
                                ->whereHas('criteria', fn ($query) => $query->whereLocationId($this->locationID))
                                ->get()->sortBy(function ($inspection) {
                                    return $inspection->criteria->criteria_type;
                                });
    }

    public function title(): string
    {
        return $this->locationID == '2' ? '5R OFFICE' : '5R WORKSHOP';
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function columnWidths(): array
    {
        return [
            // 'A' => 5,
            'B' => 33,
            'C' => 33,
            'D' => 33,
            // 'E' => 33,
            // 'F' => 10,
            // 'G' => 10,
            'H' => 13,
            // 'I' => 10,
        ];
    }
    public function collection()
    {
        $criterias = Criteria::whereLocationId($this->locationID)->get()->sortBy('criteria_type');
        $result = [];
        $number = 1;
        $currentType = $criterias->first()->criteria_type;
        $this->criteriaTypeGroupRow[$currentType] = 8;
        $criterias->each(function ($criteria) use (&$currentType, $criterias) {
            if (isset($this->criteriaTypeGroupRow[$criteria->criteria_type])) return;
            $this->criteriaTypeGroupRow[$criteria->criteria_type] = $this->criteriaTypeGroupRow[$currentType] + $criterias->where('criteria_type', $currentType)->count() + 1;
            $currentType = $criteria->criteria_type;
        });
        $typeIterator = 0;
        $criterias->values()->each(function ($criteria, $index) use (&$result, &$number, &$currentType, &$typeIterator) {
            if ($currentType != $criteria->criteria_type) {
                $currentType = $criteria->criteria_type;
                $number = 1;
                $typeIterator++;
            }
            $inspection = $this->inspections->first(function ($inspection) use ($criteria) {
                return $inspection->criteria_id == $criteria->id;
            });
            if ($inspection) $this->inspectionRow[$inspection->id] = $index + 8 + $typeIterator;
            $result[] = [
                'No' => $number++,
                'Kriteria' => $criteria->criteria_name,
                'Tipe' => $criteria->criteria_type,
                'Temuan' => $inspection ? $inspection->findings_description : '',
                'Tindak Lanjut' => $inspection ? $inspection->action_description ?? '' : '',
                'Lokasi Inspeksi' => $inspection ? $inspection->inspection_location : '',
                'Ya' => $inspection ? $inspection->suitability == 1 ? '✔' : '' : '',
                'Tidak' => $inspection ? $inspection->suitability == 0 ? '✔' : '' : '',
                'Tanggal Pemeriksaan' => $inspection ? $inspection->checkup_date : '',
                'Nilai' => $inspection ? $inspection->value : '',
            ];
        });
        return collect($result);
    }

    public function map($inspection): array
    {
        if ($inspection['No'] == 1) {
            return [
                [$inspection['Tipe']],[
                $inspection['No'],
                $inspection['Kriteria'],
                $inspection['Temuan'],
                $inspection['Tindak Lanjut'],
                $inspection['Lokasi Inspeksi'],
                $inspection['Ya'],
                $inspection['Tidak'],
                $inspection['Tanggal Pemeriksaan'],
                $inspection['Nilai'],
            ]];
        }
        return [
            $inspection['No'],
            $inspection['Kriteria'],
            $inspection['Temuan'],
            $inspection['Tindak Lanjut'],
            $inspection['Lokasi Inspeksi'],
            $inspection['Ya'],
            $inspection['Tidak'],
            $inspection['Tanggal Pemeriksaan'],
            $inspection['Nilai'],
        ];
    }

    public function drawings()
    {
        $drLogo = new Drawing();
        $drLogo->setName('Logo');
        $drLogo->setDescription('Logo Reka');
        $drLogo->setPath(public_path('/images/logo/logo-full.png'));
        $drLogo->setHeight(40);
        $drLogo->setCoordinates('A1');
        $drLogo->setOffsetX(5);
        $drLogo->setOffsetY(5);

        $drFindings = [];
        $drActions = [];

        foreach ($this->inspections as $index => $inspection) {
            $findingWidth = 0;
            foreach ($inspection->findings as $finding) {
                # code...
                $imageUrl = public_path('storage/' . $finding->image_path);

                $drFinding = new Drawing();
                $drFinding->setName('Image');
                $drFinding->setDescription('Image');
                $drFinding->setPath($imageUrl);
                $drFinding->setHeight(50);
                $drFinding->setCoordinates('C' . ($this->inspectionRow[$inspection->id]));
                $drFinding->setOffsetX($findingWidth + 5);
                $drFinding->setOffsetY(5);

                $findingWidth += $drFinding->getWidth();
                $drFindings[] = $drFinding;
            }
            
            $imageUrl = public_path('storage/' . $inspection->action_path);

            $drAction = new Drawing();
            $drAction->setName('Image');
            $drAction->setDescription('Image');
            $drAction->setPath($imageUrl);
            $drAction->setHeight(50);
            $drAction->setCoordinates('D' . ($this->inspectionRow[$inspection->id]));
            $drAction->setOffsetX(5);
            $drAction->setOffsetY(5);

            $drActions[] = $drAction;
        }

        return [$drLogo, ...$drActions, ...$drFindings];
    }

    public function styles(Worksheet $sheet) {
        $lastRow = $sheet->getHighestRow();

        $sheet->mergeCells('A1:B3');
        $sheet->getCell('C1')->setValue('Check List Inspeksi 5R');
        $sheet->mergeCells('C1:E3');
        $sheet->getCell('F1')->setValue('No');
        $sheet->mergeCells('F1:G1');
        $sheet->getCell('H1')->setValue($this->inspectionRecap->number ?? '-');
        $sheet->mergeCells('H1:I1');
        $sheet->getCell('F2')->setValue('Tgl Terbit');
        $sheet->mergeCells('F2:G2');
        $sheet->getCell('H2')->setValue($this->inspectionRecap->issued_date ?? '-');
        $sheet->mergeCells('H2:I2');
        $sheet->getCell('F3')->setValue('Keterangan');
        $sheet->mergeCells('F3:G3');
        $sheet->getCell('H3')->setValue($this->inspectionRecap->description ?? '-');
        $sheet->mergeCells('H3:I3');
        $sheet->getCell('A4')->setValue('INSPEKSI 5R PT.REKAINDO GLOBAL JASA');
        $sheet->mergeCells('A4:G4');
        
        $sheet->getCell('A5')->setValue('No');
        $sheet->mergeCells('A5:A6');
        $sheet->getCell('B5')->setValue('Kriteria');
        $sheet->mergeCells('B5:B6');
        $sheet->getCell('C5')->setValue('Temuan');
        $sheet->mergeCells('C5:C6');
        $sheet->getCell('D5')->setValue('Tindak Lanjut');
        $sheet->mergeCells('D5:D6');
        $sheet->getCell('E5')->setValue('Lokasi Inspeksi');
        $sheet->mergeCells('E5:E6');
        $sheet->getCell('F5')->setValue('Kesesuaian');
        $sheet->mergeCells('F5:G5');
        $sheet->getCell('F6')->setValue('Ya');
        $sheet->getCell('G6')->setValue('Tidak');
        $sheet->getCell('H5')->setValue('Tanggal Pemeriksaan');
        $sheet->mergeCells('H5:H6');
        $sheet->getCell('I5')->setValue('Nilai');
        $sheet->mergeCells('I5:I6');

        $sheet->getCell('A7')->setValue($this->locationID == '1' ? 'I. Workshop/Gudang' : 'II. Kantor');
        $sheet->mergeCells('A7:I7');

        $sheet->getStyle('A1:I'.$lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:I'.$lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('B7:B'.$lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('B7:B'.$lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('C7:D'.$lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C7:D'.$lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);
        
        $sheet->getStyle('A7:I' . $lastRow)->getAlignment()->setWrapText(true);

        $sheet->getStyle('A1:I'.$lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        foreach (['Rapi', 'Resik', 'Rawat', 'Rajin', 'Ringkas'] as $type) {
        // foreach (Criteria::whereLocationId($this->locationID)->get()->sortBy('criteria_type')->pluck('criteria_type')->toArray() as $type) {
            if (isset($this->criteriaTypeGroupRow[$type])) {
                $sheet->mergeCells('A'.$this->criteriaTypeGroupRow[$type].':I'.$this->criteriaTypeGroupRow[$type]);
                $sheet->getStyle('A'.$this->criteriaTypeGroupRow[$type].':I'.$this->criteriaTypeGroupRow[$type])
                      ->getAlignment()
                      ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);

        for ($row = 9; $row <= $lastRow; $row++) {
            $findingDescription = $sheet->getCell('C'.$row)->getValue();
            $actionDescription = $sheet->getCell('D'.$row)->getValue();
            
            $wrappedLineCount = max(ceil(strlen($findingDescription) / 33), ceil(strlen($actionDescription) / 33));
            logger('wrappedLineCount', [$wrappedLineCount]);
            if (!in_array($row, $this->criteriaTypeGroupRow)) {
                $sheet->getRowDimension($row)->setRowHeight($wrappedLineCount*10+55);
            }
        }
    }
}
