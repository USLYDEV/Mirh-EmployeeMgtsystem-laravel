<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;

use App\Models\Country;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;

use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';

    protected static ?string $navigationLabel = 'State';

    protected static ?string $modelLabel = 'State';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //This bring Item from other input in the DB
                Forms\Components\Select::make('country_id')
                //This is use in but does not work for my application--->RELATIONMANAGER
                // ->relationship(name: 'country', TitleAttribute: 'name')
                //I have to use this--->
                // ->relationship('country', 'name')
                ->relationship('country', 'name')
                //allow user to seach from list
                ->searchable()
                //allow multiple selection
                // ->multiple()
                //This dd the se4arch option and also list all the item below
                ->preload()
                ->required(),                                      
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('name')
                ->label('State Name')
                ->sortable(),
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
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            // 'view' => Pages\ViewState::route('/{record}'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }    
}