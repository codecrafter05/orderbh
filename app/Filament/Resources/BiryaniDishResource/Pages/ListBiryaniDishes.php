<?php

namespace App\Filament\Resources\BiryaniDishResource\Pages;

use App\Filament\Resources\BiryaniDishResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBiryaniDishes extends ListRecords
{
    protected static string $resource = BiryaniDishResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
