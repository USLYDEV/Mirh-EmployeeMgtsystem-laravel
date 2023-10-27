<?php

namespace App\Providers;

use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Support\ServiceProvider;

class AdminPanelProvider extends ServiceProvider
{

public function panel (Panel $panel): panel
    {

    return $panel
    ->default()
    ->id('admin')
    ->path('admin')
    ->colors([

    ])
    ->fonts('Inter')
    ->NavigationGroups([
        'Employee Management',
        'System Management',
        'User Management'
    ]);
    }

}