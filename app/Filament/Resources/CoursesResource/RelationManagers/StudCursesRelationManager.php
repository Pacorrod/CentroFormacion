<?php

namespace App\Filament\Resources\CoursesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use App\Models\Students;
use App\Models\Courses;
use App\Models\StudCurses;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Filament\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class StudCursesRelationManager extends RelationManager
{
    protected static string $relationship = 'StudCurses';
    protected static ?string $title = 'ALUMNOS INSCRITOS AL CURSO';
   
    
    
    public function form(Form $form): Form
    {
        $courses_id= Session::get('current_course_id');
        return $form
            
            ->schema([
                Forms\Components\Toggle::make('disable')
                ->label('Baja')
                ->columnSpanFull(),

                Forms\Components\Select::make('students_id')
                ->label('Alumno')
                
                ->columnSpanFull()
                ->options(Students::query()
                 ->pluck('name','id')),//pluck estraigo una lista de valores 

                Forms\Components\Toggle::make('documentation')
                ->label('Documentación'),

                Forms\Components\Toggle::make('subvencionable')
                ->label('Es subvencionable'),
                
                Forms\Components\TextInput::make('nota')
                ->label('Nota final curso')
                ->numeric(),

                Forms\Components\MarkdownEditor::make('comments')
                ->label('Observaciones')
                ->columnSpan('full'),

                Forms\Components\DatePicker::make('datedisable')
                    ->label('Fecha baja'),

                Forms\Components\TextInput::make('disablecomments')
                    ->label('Motivo')
                    ->maxLength(200),
            ]);
    }

    
   
    public function table(Table $table): Table
    {

       
        //obtengo el courses_id de una variable de sesion de editCourses.php
        $courses_id= Session::get('current_course_id');
        $courses_type= Session::get('current_CoursesTypeEnum');
        

        return $table
           //->recordTitleAttribute('name')
           
            ->columns([
                
               Tables\Columns\TextColumn::make('Students.name')
               ->Label("Nombre del alumno")
               ->sortable(),
               Tables\Columns\TextColumn::make('Students.phone')
               ->label("Teléfono"),
               Tables\Columns\TextColumn::make('Students.email')
               ->label("Correo electrónico"),
               Tables\Columns\TextColumn::make('comments')
               ->label("Comentarios")
               ->limit(40),
               Tables\Columns\IconColumn::make('disable')
               ->boolean()
               ->label("Baja en el curso"),
              
            ])
            ->filters([
                //
            ])
            // ->headerActions([ // ])
            ->headerActions(array_merge(
                [
                    
                    Tables\Actions\PrintPdfStudentsCourseAction::make()
                        ->label("Descargar Pdf")
                        ->icon('heroicon-m-document')
                        ->extraAttributes([
                            'color' => 'success'])
                        ->url(route('download.alumnos', ['courses_id' => $courses_id])),
                    
                    Tables\Actions\CreateAction::make()
                        ->label("Añadir alumno al curso")
                        ->icon('heroicon-m-user-plus')
                        ->modalHeading('Añadir alumno al curso'),
                ],
                // Condición para incluir SendEmailCourseAction solo si courses_type es "preparando"
                
                $courses_type === "preparando" ? 
                [
                    Tables\Actions\SendEmailCourseAction::make()
                        ->label('Enviar email de comienzo')
                        ->icon('heroicon-m-inbox')
                        ->extraAttributes([
                            'color' => 'danger'])
                        ->url(route('send.alumnos', ['courses_id' => $courses_id])),
                ] : []
                        ))
            ->actions([
                Tables\Actions\EditAction::make()
                ->modalHeading('Editar Alumnos/Cursos'),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
                //]),
            ]);
    }
}
