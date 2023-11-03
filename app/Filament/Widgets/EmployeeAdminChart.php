<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class EmployeeAdminChart extends BarChartWidget
{
    protected static ?string $heading = 'Employee';
    protected static ?int $sort = 3;
    protected static string $color = 'warning';

    protected function getData(): array
    {
        $data = Trend::model(Employee::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Employee',
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
