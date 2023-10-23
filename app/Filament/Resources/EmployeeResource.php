<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Get;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

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
                //Fecthing data from DB
                Forms\Components\Section::make('Country Information')
                    ->description('Input your information correctly')
                    ->schema([
                        //This bring Item from other input in the DB
                        //Country
                        Forms\Components\Select::make('country_id')
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()

                            ->afterStateUpdated(function ($set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })->required(),

                        //State
                        Forms\Components\Select::make('state_id')
                            //This make sure that we select option base on previus selection
                            //dependent delection    
                            ->options(fn ($get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->label('State')
                            //This clear the field input when previois field changes
                            // ->afterStateUpdated(
                                // fn ($set) => $set('city_id', null)
                            // )
                            ->required(),
                        //City
                        Forms\Components\Select::make('city_id')
                            //This fecth data base on selected state
                            ->options(fn ($get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id'))

                            ->searchable()
                            ->preload()
                            // ->live()
                            ->label('City')
                            ->required(),
                        //Department
                        Forms\Components\Select::make('department_id')
                            ->relationship('department', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                    ])->columns(2),
                //End fetching from DB

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
                Forms\Components\Section::make('Address')
                    ->description('input your information correctly')
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('zip_code')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Date')
                    ->schema([

                        Forms\Components\DatePicker::make('date_of_birth')
                            // ->native(false)
                            ->displayFormat('d/mm/Y')
                            
                            ->required(),
                        Forms\Components\DatePicker::make('date_hired')
                         // ->native(false)
                          ->displayFormat('d/mm/Y')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('first_name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('middle_name')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('department.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('state.name')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city.name')
                ->toggleable(isToggledHiddenByDefault: true),    
                Tables\Columns\TextColumn::make('address')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('zip_code')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->date(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                ->toggleable(isToggledHiddenByDefault: true)
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
            // 'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
