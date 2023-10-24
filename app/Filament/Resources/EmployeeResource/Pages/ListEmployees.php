<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
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

    public function getTabs():array 
    {
       return [
        'All' => Tab::make(),
        'This Week' => Tab::make()
            ->modifyQueryUsing (fn (Builder $query) =>$query->where('date_hired', '>=', now()->subWeek()))
          ];
     }

}