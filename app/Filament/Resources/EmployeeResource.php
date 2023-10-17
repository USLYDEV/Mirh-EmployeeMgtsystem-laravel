<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    
    protected static ?string $navigationLabel = 'Employee';
    protected static ?string $navigationGroup = 'Employee Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Full Name')
                ->description('Input your information correctly')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('middle_name')
                    ->required()
                    ->maxLength(255),
                ])->columns(3),
                Forms\Components\Section::make('Country Information')
                ->description('input your information correctly')
                ->schema([
                Forms\Components\TextInput::make('country_id')
                    ->required(),
                Forms\Components\TextInput::make('state_id')
                    ->required(),
                Forms\Components\TextInput::make('city_id')
                    ->required(),
                    Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                ])->columns(3),
                Forms\Components\Section::make('Department')
                ->schema([
                Forms\Components\TextInput::make('department_id')
                    ->required(),         
                ]),

                Forms\Components\Section::make('Date')
                ->schema([
                     
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required(),
                Forms\Components\DatePicker::make('date_hired')
                    ->required(),
                ])->columns(2),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_id'),
                Tables\Columns\TextColumn::make('state_id'),
                Tables\Columns\TextColumn::make('city_id'),
                Tables\Columns\TextColumn::make('department_id'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('middle_name'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('zip_code'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }    
}
