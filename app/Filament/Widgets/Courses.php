<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CoursesResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Courses extends BaseWidget
{
    
    protected static ?int $sort = 3; // orden en la pantalla
    protected int| string | array $columnSpan='full';
    

    public function table(Table $table): Table
    {
       
        $currentYear = date('Y');
        // Obtener la consulta inicial
        $query = CoursesResource::getEloquentQuery();
        // Agregar la condición para filtrar los cursos del año actual
        $query->whereYear('startdate', $currentYear);
        
    return $table
            ->heading('Cursos')
            ->query($query)
            ->defaultSort('startdate','desc')

            ->columns([
                Tables\Columns\ImageColumn::make('picture')
                ->label('')
                ->square(),
                Tables\Columns\TextColumn::make('name')
                ->label('Nombre')
                ->sortable()
                ->weight('bold'),
                Tables\Columns\TextColumn::make('expedient')->label('Expediente'),
                Tables\Columns\TextColumn::make('startdate')
                    ->label('Fecha inicio')
                    ->date('d-m-yy')
                    ->sortable(),
                Tables\Columns\TextColumn::make('enddate')
                    ->label('Fecha fin')
                    ->date('d-m-yy'),
                Tables\Columns\TextColumn::make('CoursesTypeEnum')
                    ->label('Estado')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'primary',
                        'preparando' => 'info',
                        'encurso' => 'success',
                        'finalizado' => 'danger',
                        'archivado' => 'light',
                    }),
                Tables\Columns\TextColumn::make('CoursesClassEnum')->label('Convocatoria'),
                Tables\Columns\TextColumn::make('CoursesModoEnum')->label('Tipo')
            ]);
    }
}
