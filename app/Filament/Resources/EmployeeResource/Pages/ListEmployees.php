<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    //TAB Start here
    public function getTabs():array 
    {
       return [
        'All' => Tab::make('All'),
        'This Week' => Tab::make('This Week')
            ->modifyQueryUsing (fn (Builder $query) =>$query->where('date_hired', '>=', now()->subWeek()))
                //Add badge count to the filter tab
            ->badge(Employee::query()->where('date_hired', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make('This Month')
            ->modifyQueryUsing (fn (Builder $query) =>$query->where('date_hired', '>=', now()->subMonth())),
            'This Year' => Tab::make('This Year')
            ->modifyQueryUsing (fn (Builder $query) =>$query->where('date_hired', '>=', now()->subYear()))
          ];
     }
     //TAB END

}