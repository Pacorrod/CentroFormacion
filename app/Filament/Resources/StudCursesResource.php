<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudCursesResource\Pages;
use App\Filament\Resources\StudCursesResource\RelationManagers;
use App\Models\Courses;
use App\Models\StudCurses;
use App\Models\Students;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudCursesResource extends Resource
{
    protected static ?string $model = StudCurses::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?int $navigationSort=3;

    protected static ?string $navigationLabel = 'Alumnos por Curso';

    protected static ?string $modelLabel = 'Alumnos por curso';
    
    public static ?string $navigationGroup='Gestión';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                 Forms\Components\Toggle::make('disable')
                 ->label('Baja')
                 ->columnSpanFull(),

                Forms\Components\Select::make('courses_id')
                ->label('Curso')
                ->options(Courses::query()
                    ->where('CoursesTypeEnum', 'pendiente')
                    ->orWhere('CoursesTypeEnum','preparando')
                    ->orWhere('CoursesTypeEnum','encurso')
                    ->pluck('name','id'))//pluck estraigo una lista de valores 
                ->required(), 
               
                Forms\Components\Select::make('students_id')
                ->label('Alumno')
                ->options(Students::query()
                ->where('removed',false)
                ->pluck('name','id'))//pluck estraigo una lista de valores 
                 ->required(),

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('Courses.name')
               ->label('Curso'),
               Tables\Columns\TextColumn::make('Students.name')
               ->label('Alumno')
               ->searchable(),
               Tables\Columns\IconColumn::make('documentation')
               ->label('documentation')
               ->boolean(),
               Tables\Columns\IconColumn::make('subvencionable')
               ->label('Subvencionable')
               ->boolean(),
               Tables\Columns\TextColumn::make('comments')
               ->label('Observaciones')
               ->limit(30),
            
               

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudCurses::route('/'),
            'create' => Pages\CreateStudCurses::route('/create'),
            'edit' => Pages\EditStudCurses::route('/{record}/edit'),
        ];
    }
}
