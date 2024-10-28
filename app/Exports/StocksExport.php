<?php

namespace App\Exports;

use App\Models\Stocks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StocksExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of stocks to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Stocks::with('category')->get()->map(function ($stock) {
            return [
                'ID' => $stock->id,
                'Food' => $stock->food,
                'Expiration Date' => $stock->expiration_date,
                'Quantity' => $stock->quantity,
                'Location' => $stock->location,
                'Category' => $stock->category->type ?? 'No Category',
            ];
        });
    }

    /**
     * Return the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Food',
            'Expiration Date',
            'Quantity',
            'Location',
            'Category',
        ];
    }
}
