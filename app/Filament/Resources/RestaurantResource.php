<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestaurantResource\Pages;
use App\Filament\Resources\RestaurantResource\RelationManagers;
use App\Models\Restaurant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
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
                            ->maxLength(255),
                        TextInput::make('working_hours_ar')
                            ->label('ساعات العمل (عربي)')
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
                            ->maxLength(255),
                        TextInput::make('working_hours_en')
                            ->label('Working Hours (EN)')
                            ->maxLength(255),
                    ]),
                FileUpload::make('image_path')
                    ->label('صورة المطعم')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('restaurants'),
                Section::make('بيانات SEO')
                    ->description('إضافة كلمات مفتاحية ووصف للمطعم لتحسين محركات البحث')
                    ->schema([
                        Section::make('البيانات العربية - SEO')
                            ->schema([
                                Textarea::make('description_ar')
                                    ->label('وصف المطعم (عربي)')
                                    ->rows(4)
                                    ->maxLength(500)
                                    ->helperText('وصف مختصر عن المطعم (حد أقصى 500 حرف)')
                                    ->columnSpanFull(),
                                Textarea::make('keywords_ar')
                                    ->label('الكلمات المفتاحية (عربي)')
                                    ->rows(3)
                                    ->maxLength(255)
                                    ->helperText('أدخل الكلمات المفتاحية مفصولة بفواصل (مثال: مطعم، أردني، منسف، توصيل)')
                                    ->columnSpanFull(),
                            ]),
                        Section::make('English Data - SEO')
                            ->schema([
                                Textarea::make('description_en')
                                    ->label('Restaurant Description (EN)')
                                    ->rows(4)
                                    ->maxLength(500)
                                    ->helperText('Brief description about the restaurant (max 500 characters)')
                                    ->columnSpanFull(),
                                Textarea::make('keywords_en')
                                    ->label('Keywords (EN)')
                                    ->rows(3)
                                    ->maxLength(255)
                                    ->helperText('Enter keywords separated by commas (e.g., restaurant, jordanian, mansaf, delivery)')
                                    ->columnSpanFull(),
                            ]),
                    ]),
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
