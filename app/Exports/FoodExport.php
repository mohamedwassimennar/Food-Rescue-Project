<?php

namespace App\Exports;

use App\Models\Food;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FoodExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        return Food::query()->with('restaurant:id,name');
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Food Name',
            'Fats',
            'Carbs',
            'Proteins',
            'Calories',
            'Restaurant Name',
        ];
    }

    /**
    * @param Food $food
    * @return array
    */
    public function map($food): array
    {
        return [
            $food->name,
            $food->fats,
            $food->carbs,
            $food->proteins,
            $food->calories,
            $food->restaurant ? $food->restaurant->name : 'unknown', 
        ];
    }
}
