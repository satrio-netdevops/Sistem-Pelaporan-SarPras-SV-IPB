<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ReportsExport implements FromCollection, WithHeadings, WithMapping
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
}
