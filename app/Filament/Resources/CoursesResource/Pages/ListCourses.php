<?php

namespace App\Filament\Resources\CoursesResource\Pages;


use App\Filament\Resources\CoursesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCourses extends ListRecords
{
    protected static string $resource = CoursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
           
        ];
    }

    public function getTabs(): array //Para poner la lista de opciones para filtrar la tabla
    {
        return [
            'Todos' => Tab::make(),

            'pendiente' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('CoursesTypeEnum', "pendiente")),
            'En preparación' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('CoursesTypeEnum', "preparando")),
            'En curso' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('CoursesTypeEnum', "encurso")),
            'Finalizado' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('CoursesTypeEnum', "finalizado")),
            'Archivado' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('CoursesTypeEnum', "archivado")),
        ];
    }

    public function getDefaultActiveTab(): string | int | null // Para predeterminar el filtro al abrie la página
    {
        return 'En curso';
    }
}
