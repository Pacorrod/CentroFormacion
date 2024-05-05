<?php

namespace App\Http\Controllers;

use App\Models\StudCurses;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;

class PDFController extends Controller
{
    public function downloadpdf($id){
        
        //$students = StudCurses::all();
        $students = StudCurses::where('courses_id', $id)
                                ->where('disable', false)
                                ->with('courses') //Asi paso los campos del curso haciendo uso de la relación
                                ->get();
        
        if ($students->isEmpty()) {
            
            Notification::make()
            ->title('No se puede generar el pdf, no hay alumnos en el curso')
            ->icon('heroicon-o-exclamation-circle')
            ->iconColor('danger')
            ->send();
            return redirect()->back();

        } else {
            $data = [
                'date' => date('m/d/Y'),
                'students' => $students
            ];
            $pdf = PDF::loadView('studentsPDF', $data);
            return $pdf->download('alumnosencurso.pdf');
        }
        
       

    } 
}
