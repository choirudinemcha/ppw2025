<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Application::with(['user', 'job'])->get();
    }

    /**
     * Map each application row for export.
     */
    public function map($application): array
    {
        return [
            $application->id,
        ];
    }

    /**
     * Define header columns for the exported file.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelamar',
            'Email Pelamar',
            'Judul Lowongan',
            'Perusahaan',
            'Status',
            'Tanggal Dibuat',
        ];
    }
}
