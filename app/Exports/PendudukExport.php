<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendudukExport implements FromQuery, WithHeadings, WithMapping
{
    protected $columns;
    protected $search;

    public function __construct($columns, $search = null)
    {
        $this->columns = $columns;
        $this->search = $search;
    }

    public function query()
    {
        $query = Warga::query();
        if ($this->search) {
            $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('nik', 'like', '%' . $this->search . '%');
        }
        return $query;
    }

    public function headings(): array
    {
        return array_map(function ($col) {
            return strtoupper(str_replace('_', ' ', $col));
        }, $this->columns);
    }

    public function map($warga): array
    {
        $data = [];
        foreach ($this->columns as $col) {
            $data[] = $warga->{$col} ?? '-';
        }
        return $data;
    }
}