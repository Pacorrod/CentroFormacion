<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\StudCurses;
use App\Models\Courses;
use Filament\Filament;
use Filament\Notifications\Notification;

class SendController extends Controller
{
    public function SendEmailStart($id){
        
       
        $course = Courses::findOrFail($id);
        $students = StudCurses::where('courses_id', $id)
                                ->where('disable', false)
                                ->get();
        
        // Enviar el correo electrónico
        
        foreach ($students as $student) {
            Mail::send('mailstart', ['course' => $course], function($m) use ($student, $course) {
                // Establecer el remitente del correo
                $m->from('pacorrod7@gmail.com');
                // Agregar el estudiante como destinatario del correo
                
                $m->to($student->students->email, $student->students->name);
                // Personalizar el asunto del correo
                $m->subject('Aviso del Centro de Formación');

                
            });
        }
        Notification::make()
        ->title('Se han enviado los correos electrónicos')
        ->icon('heroicon-o-document-text')
        ->iconColor('success')
        ->send();

        return redirect()->back();
    } 
}
