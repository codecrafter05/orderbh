<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Category';
    protected static ?string $navigationGroup = 'Menu Zohoor';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('البيانات العربية')
                    ->schema([
                        TextInput::make('name_ar')
                            ->label('اسم الكاتوقري (عربي)')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('English Data')
                    ->schema([
                        TextInput::make('name_en')
                            ->label('Category Name (EN)')
                            ->required()
                            ->maxLength(255),
                    ]),
                FileUpload::make('image_path')
                    ->label('صورة الكاتوقري')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('categories'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
