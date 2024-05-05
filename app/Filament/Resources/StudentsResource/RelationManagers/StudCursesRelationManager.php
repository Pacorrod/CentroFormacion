<?php

namespace App\Filament\Resources\StudentsResource\RelationManagers;

use App\Models\Courses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudCursesRelationManager extends RelationManager
{
    protected static string $relationship = 'StudCurses';

    
    
    public function form(Form $form): Form
    {
        return $form
            
            ->schema([
                
                Forms\Components\Toggle::make('disable')
                ->label('Baja')
                ->columnSpanFull(),

                Forms\Components\Select::make('courses_id')
                ->label('Curso')
                ->options(Courses::query()
                    ->pluck('name','id'))//pluck estraigo una lista de valores 
                ->columnSpanFull()
                ->disabled(true),

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
        
        return $table
            //->recordTitleAttribute('name')
            
            ->heading('Cursos del Alumno')
            
            ->columns([
                Tables\Columns\ImageColumn::make('Courses.picture')
                ->label('')
                ->square(),
                Tables\Columns\TextColumn::make('Courses.name')
                ->label("Nombre del curso"),
                Tables\Columns\TextColumn::make('Courses.startdate')
                ->label("Fecha inicio")
                ->date('d-m-yy')
                ->sortable(),
                Tables\Columns\TextColumn::make('Courses.enddate')
                ->date('d-m-yy')
                ->label("Fecha fin"),
                Tables\Columns\TextColumn::make('nota')
                ->label("Nota final"),
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
            ->headerActions([
               // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->modalHeading('Editar Alumnos/Cursos'),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                //]),
            ]);
    }
}
