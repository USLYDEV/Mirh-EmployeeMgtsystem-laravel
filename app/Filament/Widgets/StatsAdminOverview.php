<?php
 
namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
 
class StatsAdminOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Users', User::query()->count())
            ->description('Current users')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
          Card::make('Employees', Employee::query()->count())
            ->description('Current Employees')
            // ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
         Card::make('Department', Department::query()->count())
            ->description('Active Department')
            // ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}