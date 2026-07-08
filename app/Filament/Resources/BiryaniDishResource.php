<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BiryaniDishResource\Pages;
use App\Models\BiryaniDish;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BiryaniDishResource extends Resource
{
    protected static ?string $model = BiryaniDish::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Dishes';

    protected static ?string $navigationGroup = 'Biryani To Go';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('البيانات العربية')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name_ar')
                            ->label('اسم الطبق (عربي)')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description_ar')
                            ->label('وصف الطبق (عربي)')
                            ->rows(3)
                            ->maxLength(2000),
                    ]),
                Section::make('English Data')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name_en')
                            ->label('Dish Name (EN)')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description_en')
                            ->label('Dish Description (EN)')
                            ->rows(3)
                            ->maxLength(2000),
                    ]),
                FileUpload::make('image_path')
                    ->label('صورة الطبق')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('biryani-dishes'),
                Repeater::make('prices')
                    ->label('أسعار الطبق')
                    ->helperText('يمكنك إضافة سعر فقط أو سعر مع حجم/عدد.')
                    ->schema([
                        TextInput::make('size_ar')
                            ->label('الحجم/العدد (عربي)')
                            ->maxLength(100),
                        TextInput::make('size_en')
                            ->label('Size/Count (EN)')
                            ->maxLength(100),
                        TextInput::make('price')
                            ->label('السعر')
                            ->numeric()
                            ->required(),
                    ])
                    ->defaultItems(1),
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
            'index' => Pages\ListBiryaniDishes::route('/'),
            'create' => Pages\CreateBiryaniDish::route('/create'),
            'edit' => Pages\EditBiryaniDish::route('/{record}/edit'),
        ];
    }
}
