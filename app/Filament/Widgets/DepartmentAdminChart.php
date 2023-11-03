<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class DepartmentAdminChart extends BarChartWidget
{
    protected static ?string $heading = 'Department';

    protected static ?int $sort = 2;
    protected static string $color = 'warning';
    protected function getData(): array
    {
        $data = Trend::model(Department::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Department',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
