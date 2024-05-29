<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Students;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class SendPubliController extends Controller
{
   public function SendEmailPubli(int $id): \Illuminate\Http\RedirectResponse
   {

    $course = Courses::findOrFail($id);
    $students = Students::where('disable', false)->get();

    // Enviar el correo electrónico en lotes para no saturar el servidor
        
    $batchSize = 20; // Tamaño del lote

    $totalStudents = $students->count();
    $totalBatches = ceil($totalStudents / $batchSize);
    
    for ($i = 0; $i < $totalBatches; $i++) {
        $offset = $i * $batchSize;
        $batchStudents = $students->slice($offset, $batchSize);
    
        foreach ($batchStudents as $student) {
            Mail::send('mailPublic', ['course' => $course, 'student' => $student], function ($m) use ($student) {
                // Establecer el remitente del correo
                $m->from('pacorrod7@gmail.com');
                // Agregar el estudiante como destinatario del correo
                $m->to($student->email, $student->name);
                // Personalizar el asunto del correo
                $m->subject('Nuevo curso');
            });
        }
    }

    Notification::make()
        ->title('Se han enviado los correos electrónicos')
        ->icon('heroicon-o-document-text')
        ->iconColor('success')
        ->send();

    return redirect()->back();
   }
}
