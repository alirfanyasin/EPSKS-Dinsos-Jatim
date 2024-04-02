<?php

namespace App\Exports;

use App\Models\Pillars\Kartar\KarangTarunaReport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportKartarExport implements FromQuery, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($select)
    {
        $this->select = $select;
    }

    public function query()
    {
        if ($this->select == 'bulanan') {
            return KarangTarunaReport::query()->where('period', '1');
        }
        if ($this->select == 'tahunan') {
            return KarangTarunaReport::query()->where('period', '2');
        }
    }

    public function map($data): array
    {
        static $number = 0;

        if ($data->period == '1') {
            $data->period = 'Bulanan';
            $data->time = $data->month;
        };
        if ($data->period == '2') {
            $data->period = 'Tahunan';
            $data->time = $data->year;
        };

        $number++;

        return [
            $number,
            $data->name_kartar,
            $data->period,
            $data->time,
            $data->status,
        ];
    }
}
