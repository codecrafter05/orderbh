<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestaurantResource\Pages;
use App\Filament\Resources\RestaurantResource\RelationManagers;
use App\Models\Restaurant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RestaurantResource extends Resource
{
    protected static ?string $model = Restaurant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('البيانات العربية')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name_ar')
                            ->label('اسم المطعم (عربي)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('type_ar')
                            ->label('نوع المطعم (عربي)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('delivery_time_ar')
                            ->label('وقت التوصيل (عربي)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('working_hours_ar')
                            ->label('ساعات العمل (عربي)')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('English Data')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name_en')
                            ->label('Restaurant Name (EN)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('type_en')
                            ->label('Restaurant Type (EN)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('delivery_time_en')
                            ->label('Delivery Time (EN)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('working_hours_en')
                            ->label('Working Hours (EN)')
                            ->required()
                            ->maxLength(255),
                    ]),
                FileUpload::make('image_path')
                    ->label('صورة المطعم')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('restaurants'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('الصورة')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('name_ar')
                    ->label('الاسم (عربي)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_en')
                    ->label('Name (EN)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_ar')
                    ->label('النوع (عربي)'),
                Tables\Columns\TextColumn::make('type_en')
                    ->label('Type (EN)'),
                Tables\Columns\TextColumn::make('delivery_time_ar')
                    ->label('وقت التوصيل (عربي)'),
                Tables\Columns\TextColumn::make('working_hours_ar')
                    ->label('ساعات العمل (عربي)'),
            ])
            ->reorderable('order')
            ->defaultSort('order', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRestaurants::route('/'),
            'create' => Pages\CreateRestaurant::route('/create'),
            'edit' => Pages\EditRestaurant::route('/{record}/edit'),
        ];
    }
}
