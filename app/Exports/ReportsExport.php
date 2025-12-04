<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReportsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $reports;

    public function __construct(Collection $reports)
    {
        $this->reports = $reports;
    }

    public function collection()
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            'Waktu',
            'Pelapor',
            'Objek',
            'Lokasi',
            'Tipe Laporan',
            'Tipe Aset',
            'Deskripsi',
            'Status'
        ];
    }

    public function map($report): array
    {
        return [
            $report->created_at->format('Y-m-d H:i'),
            optional($report->user)->name,
            $report->object_name,
            $report->location,
            $report->report_type,
            $report->asset_type,
            $report->description,
            $report->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $highestColumn . $highestRow;

        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'CCCCCC']]],
            $range => ['borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20, // Waktu
            'B' => 20, // Pelapor
            'C' => 20, // Objek
            'D' => 20, // Lokasi
            'E' => 20, // Tipe Laporan
            'F' => 20, // Tipe Aset
            'G' => 30, // Deskripsi
            'H' => 20, // Status
        ];
    }

    public function title(): string
    {
        return 'Laporan Sarana dan Prasarana';
    }
}
