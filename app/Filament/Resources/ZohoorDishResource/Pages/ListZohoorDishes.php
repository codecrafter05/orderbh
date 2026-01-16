<?php

namespace App\Filament\Resources\ZohoorDishResource\Pages;

use App\Filament\Resources\ZohoorDishResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZohoorDishes extends ListRecords
{
    protected static string $resource = ZohoorDishResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
