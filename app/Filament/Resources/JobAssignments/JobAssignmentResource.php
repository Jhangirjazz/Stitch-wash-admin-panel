<?php

namespace App\Filament\Resources\JobAssignments;

use UnitEnum;
use App\Filament\Resources\JobAssignments\Pages\CreateJobAssignment;
use App\Filament\Resources\JobAssignments\Pages\EditJobAssignment;
use App\Filament\Resources\JobAssignments\Pages\ListJobAssignments;
use App\Filament\Resources\JobAssignments\Schemas\JobAssignmentForm;
use App\Filament\Resources\JobAssignments\Tables\JobAssignmentsTable;
use App\Models\JobAssignment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobAssignmentResource extends Resource
{
    protected static ?string $model = JobAssignment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Operations';
    protected static ?int $navigationSort = 2; // adjust per resource

    public static function form(Schema $schema): Schema
    {
        return JobAssignmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobAssignmentsTable::configure($table);
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
            'index' => ListJobAssignments::route('/'),
            'create' => CreateJobAssignment::route('/create'),
            'edit' => EditJobAssignment::route('/{record}/edit'),
        ];
    }

        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $typeMap = [
            'laundry_pickup' => 'laundry_order',
            'laundry_delivery' => 'laundry_order',
            'tailor_visit' => 'tailor_booking',
        ];
        $data['reference_type'] = $typeMap[$data['assignment_type']] ?? null;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $typeMap = [
            'laundry_pickup' => 'laundry_order',
            'laundry_delivery' => 'laundry_order',
            'tailor_visit' => 'tailor_booking',
        ];
        $data['reference_type'] = $typeMap[$data['assignment_type']] ?? null;
        return $data;
    }


}
