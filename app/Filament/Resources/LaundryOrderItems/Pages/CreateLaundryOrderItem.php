<?php

namespace App\Filament\Resources\LaundryOrderItems\Pages;

use App\Filament\Resources\LaundryOrderItems\LaundryOrderItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaundryOrderItem extends CreateRecord
{
    protected static string $resource = LaundryOrderItemResource::class;
}
