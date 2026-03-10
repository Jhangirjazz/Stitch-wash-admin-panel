<?php

namespace App\Filament\Resources\JobAssignments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class JobAssignmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Select::make('assignment_type')
                    ->options([
                        'laundry_pickup' => 'Laundry Pickup',
                        'laundry_delivery' => 'Laundry Delivery',
                        'tailor_visit' => 'Tailor Visit',
                    ])
                    ->required()
                    ->live(),
                // Polymorphic reference – we'll use a custom select based on assignment_type
                Select::make('reference_id')
                    ->label('Reference')
                    ->options(function ($get) {
                        $type = $get('assignment_type');
                        // Debug: dump to log
                        \Log::info('Assignment type: ' . ($type ?? 'null'));
                        if ($type === 'laundry_pickup' || $type === 'laundry_delivery') {
                            return \App\Models\LaundryOrder::query()->pluck('order_number', 'id');
                        } elseif ($type === 'tailor_visit') {
                            return \App\Models\TailorBooking::query()->pluck('booking_number', 'id');
                        }
                        return [];
                    })
                    ->live() // make sure it's live
                    ->required(),
                                // The reference_type is set automatically based on assignment_type
                Select::make('assigned_to')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('assigned_by')
                    ->relationship('assignedBy', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'assigned' => 'Assigned',
                        'en_route' => 'En Route',
                        'arrived' => 'Arrived',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ])
                    ->default('assigned')
                    ->required(),
                DateTimePicker::make('scheduled_at')
                    ->nullable(),
                DateTimePicker::make('started_at')
                    ->nullable(),
                DateTimePicker::make('completed_at')
                    ->nullable(),
                Textarea::make('notes')
                    ->nullable(),
                FileUpload::make('proof_photo_url')
                    ->image()
                    ->directory('job-proofs')
                    ->visibility('public')
                    ->nullable(),
                // Placeholder for created_at/updated_at on edit
                Grid::make(1)
                    ->schema([
                        Placeholder::make('created_at')
                            ->label('Created')
                            ->content(fn ($record) => $record?->created_at?->format('Y-m-d H:i:s'))
                            ->visibleOn('edit'),
                        Placeholder::make('updated_at')
                            ->label('Last Updated')
                            ->content(fn ($record) => $record?->updated_at?->format('Y-m-d H:i:s'))
                            ->visibleOn('edit'),
                    ]),
            ]);
    }
}