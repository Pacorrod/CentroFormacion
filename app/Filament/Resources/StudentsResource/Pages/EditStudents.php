<?php

namespace App\Filament\Resources\StudentsResource\Pages;

use App\Filament\Resources\StudentsResource;
use App\Models\Students;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditStudents extends EditRecord
{
    protected static string $resource = StudentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make()
           // ->after(function (Students $record) {
                // Borrar los pdfs al borrar al alumno
               // if ($record->dnipdf) {
                  // Storage::disk('public')->delete($record->dnipdf);
               // }
                // Borrar los pdfs si fuera multiple
                // if ($record->galery) {
                //    foreach ($record->galery as $ph) Storage::disk('public')->delete($ph);
                // }
            // }),
        ];
    }
    
}
