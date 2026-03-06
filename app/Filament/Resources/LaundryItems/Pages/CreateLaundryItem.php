<?php

namespace App\Filament\Resources\LaundryItems\Pages;

use App\Filament\Resources\LaundryItems\LaundryItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaundryItem extends CreateRecord
{
    protected static string $resource = LaundryItemResource::class;
}
