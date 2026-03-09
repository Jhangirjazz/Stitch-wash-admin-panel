<?php

namespace App\Filament\Resources\LaundryOrders\Pages;

use App\Filament\Resources\LaundryOrders\LaundryOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaundryOrder extends CreateRecord
{
    protected static string $resource = LaundryOrderResource::class;
}
