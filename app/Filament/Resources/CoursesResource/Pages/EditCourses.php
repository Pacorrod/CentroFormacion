<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use App\Models\Courses;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Session;

class EditCourses extends EditRecord
{
    protected static string $resource = CoursesResource::class;

   
    
    protected function getHeaderActions(): array
    {
        // Obtener el ID del curso solo
       // $courseId = $this->record->getKey();

       // Obtener el modelo del curso y así puedo obtener cualquier campo del modelo
    $course = Courses::find($this->record->getKey());
    
    // Obtener el ID del curso
    $courseId = $course->id;

    // Obtener CoursesTypeEnum
    $courseType = $course->CoursesTypeEnum;

    // Guardar el ID del curso en una variable de sesión y el estado del curso para usarlo en el StudCursesRelationManager
    Session::put('current_course_id', $courseId);
    Session::put('current_CoursesTypeEnum', $courseType);
        
    if ($courseType === "preparando") {
        return [
        // Actions\DeleteAction::make(),
        
            Actions\SendEmailCursoAction::make()
            ->label('Enviar email de publicidad')
            ->icon('heroicon-m-inbox')
            ->extraAttributes([
                'color' => 'info'])
            //->url(route('sendPubli.alumnos', ['courses_id' => $courseId])),
            ->action(fn () => redirect()->route('sendPubli.alumnos', ['courses_id' => $courseId])) // Con action() puedo usar las confirmaciones de Filament
            ->requiresConfirmation(true),
        ];
    }else{
        return [];
    }

    }
}
