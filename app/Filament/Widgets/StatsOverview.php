<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Enums\CoursesTypeEnum;
use App\Models\Courses;
use App\Models\Students;
use App\Models\StudCurses;


class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2; // orden en la pantalla

    protected function getStats(): array
    {
        return [
            Stat::make('', Courses::where('CoursesTypeEnum', CoursesTypeEnum::PENDIENTE->value)->count())
            ->description('Cursos pendientes')
            ->color('primary')
            ->chart([7,5,3,6,8,4,6]),
            Stat::make('', Courses::where('CoursesTypeEnum', CoursesTypeEnum::PREPARANDO->value)->count())
            ->description('Cursos en preparación')
            ->color('info')
            ->chart([7,5,3,6,8,4,6]),
            Stat::make('', Courses::where('CoursesTypeEnum', CoursesTypeEnum::ENCURSO->value)->count())
            ->description('Cursos en curso')
            ->color('success')
            ->chart([7,5,3,6,8,4,6]),
            Stat::make('', Courses::where('CoursesTypeEnum', CoursesTypeEnum::FINALIZADO->value)->count())
            ->description('Cursos finalizados')
            ->color('danger')
            ->chart([7,5,3,6,8,4,6]),
        ];
    }
}
