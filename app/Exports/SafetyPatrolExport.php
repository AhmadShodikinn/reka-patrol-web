<?php

namespace App\Exports;

use App\Models\SafetyPatrol;
use App\Models\SafetyPatrolRecap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SafetyPatrolExport implements FromCollection, WithHeadings, WithDrawings, WithCustomStartCell, WithStyles, WithTitle
{
    use Exportable;

    private Collection $safetyPatrols;
    public function __construct(protected SafetyPatrolRecap $safetyPatrolRecap) {
        $this->safetyPatrols = SafetyPatrol::whereBetween('created_at', [$this->safetyPatrolRecap->from_date, $this->safetyPatrolRecap->to_date])
                                           ->whereIsValidEntry(true)
                                           ->get();
    }

    public function title(): string
    {
        return 'SAFETY PATROL';
    }
    
    public function startCell(): string
    {
        return 'A5';
    }

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

    public function collection()
    {
        if ($this->safetyPatrols->isEmpty()) {
            return collect([array_fill_keys($this->headings(), '')]);
        }
        return $this->safetyPatrols->map(function ($safetyPatrol, $index) {
            return [
                'No' => $index + 1,
                'Temuan' => $safetyPatrol->findings_description,
                'Lokasi' => $safetyPatrol->location,
                'Kategori' => $safetyPatrol->category,
                'Resiko' => $safetyPatrol->risk,
                'Tanggal Pemeriksaan' => $safetyPatrol->checkup_date,
                'Tindak Lanjut' => $safetyPatrol->action_description,
            ];
        });
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

        foreach ($this->safetyPatrols as $index => $safetyPatrol) {
            $findingWidth = 0;
            foreach ($safetyPatrol->findings as $finding) {
                # code...
                $imageUrl = public_path('storage/' . $finding->image_path);
                // $imageUrl = public_path('/images/logo/Asset 2@3x.png');

                $drFinding = new Drawing();
                $drFinding->setName('Image');
                $drFinding->setDescription('Image');
                $drFinding->setPath($imageUrl);
                $drFinding->setHeight(50);
                $drFinding->setCoordinates('B' . ($index + 6)); // Assuming the image should be in column B
                $drFinding->setOffsetX($findingWidth + 5);
                $drFinding->setOffsetY(5);

                $findingWidth += $drFinding->getWidth();
                $drFindings[] = $drFinding;
            }
            
            $imageUrl = public_path('storage/' . $safetyPatrol->action_path);
            // $imageUrl = public_path('/images/logo/Asset 2@3x.png');

            $drAction = new Drawing();
            $drAction->setName('Image');
            $drAction->setDescription('Image');
            $drAction->setPath($imageUrl);
            $drAction->setHeight(50);
            $drAction->setCoordinates('G' . ($index + 6)); // Assuming the image should be in column B
            $drAction->setOffsetX(5);
            $drAction->setOffsetY(5);

            $drActions[] = $drAction;
        }

        return [$drLogo, ...$drFindings, ...$drActions];
    }

    public function styles(Worksheet $sheet) {
        $lastRow = $sheet->getHighestRow();

        $sheet->getCell('C1')->setValue('Form Safety Patrol');
        $sheet->mergeCells('C1:E3');
        $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getCell('F1')->setValue('No');
        $sheet->getCell('G1')->setValue($this->safetyPatrolRecap->number ?? '-');
        $sheet->getCell('F2')->setValue('Tgl Terbit');
        $sheet->getCell('G2')->setValue($this->safetyPatrolRecap->issued_date ?? '-');
        $sheet->getCell('F3')->setValue('Keterangan');
        $sheet->getCell('G3')->setValue($this->safetyPatrolRecap->description ?? '-');
        $sheet->mergeCells('A1:B3');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getCell('A4')->setValue('SAFETY PATROL PT.REKAINDO GLOBAL JASA');
        $sheet->mergeCells('A4:G4');
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // $table = new Table('A5:G' . $sheet->getHighestRow(), 'No');
        // $tableStyle = new TableStyle(TableStyle::TABLE_STYLE_LIGHT15);
        // $tableStyle->setShowRowStripes(true);
        // $table->setStyle($tableStyle);
        // $sheet->addTable($table);
        $sheet->getStyle('A1:G'.$lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setWidth(33);
        $sheet->getStyle('B')->getAlignment()->setWrapText(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setWidth(33);
        $sheet->getStyle('G')->getAlignment()->setWrapText(true);
        for ($row = 6; $row <= $lastRow; $row++) {
            $wrappedLineCount = max(ceil(strlen($this->safetyPatrols[$row - 6]->findings_description) / 36), ceil(strlen($this->safetyPatrols[$row - 6]->action_description) / 36));
            $sheet->getRowDimension($row)->setRowHeight($wrappedLineCount*9+50);
        }
    }
}
