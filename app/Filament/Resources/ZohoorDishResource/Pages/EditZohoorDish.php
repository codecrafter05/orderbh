<?php

namespace App\Filament\Resources\ZohoorDishResource\Pages;

use App\Filament\Resources\ZohoorDishResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZohoorDish extends EditRecord
{
    protected static string $resource = ZohoorDishResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
