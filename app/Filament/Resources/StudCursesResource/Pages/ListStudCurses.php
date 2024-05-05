<?php

namespace App\Filament\Resources\StudCursesResource\Pages;

use App\Filament\Resources\StudCursesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudCurses extends ListRecords
{
    protected static string $resource = StudCursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
