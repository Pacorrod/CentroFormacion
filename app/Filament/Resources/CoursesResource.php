<?php

namespace App\Filament\Resources;

use App\Enums\CoursesClassEnum;
use App\Enums\CoursesModoEnum;
use App\Enums\CoursesTypeEnum;
use App\Filament\Resources\CoursesResource\Pages;
use App\Filament\Resources\CoursesResource\RelationManagers;
use App\Models\Courses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CoursesResource extends Resource
{
    protected static ?string $model = Courses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort=1;

    protected static ?string $navigationLabel = 'Cursos';

    protected static ?string $modelLabel = 'Cursos';

    public static ?string $navigationGroup='Gestión';

    public static function getNavigationBadge(): ?string
    {
        $currentYear = date('Y');
        return static::getModel()::whereRaw('YEAR(startdate) = ?', [$currentYear])->count();
    }

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->columnSpan('full')
                                    //->unique(ignoreRecord: true) // al editar que ignore el mismo registro
                                    ->required()
                                    ->maxValue(255),

                                Forms\Components\TextInput::make('expedient')
                                    ->label('Expediente')
                                    ->maxValue(150),

                                Forms\Components\TextInput::make('certificatecode')
                                    ->label('Cod. Certificado')
                                    ->maxValue(150),

                                Forms\Components\TextInput::make('hours')
                                    ->label('Nº horas')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(600)
                                    ->required(),

                                Forms\Components\TextInput::make('nstudents')
                                    ->label('Nº Alumnos')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(50)
                                    ->required(),

                                Forms\Components\TextInput::make('schedule')
                                    ->label('Horario'),

                                Forms\Components\Select::make('CoursesTypeEnum')
                                    ->label('Estado del curso')
                                    ->options([
                                        'pendiente' => CoursesTypeEnum::PENDIENTE->value,
                                        'preparando' => CoursesTypeEnum::PREPARANDO->value,
                                        'encurso' => CoursesTypeEnum::ENCURSO->value,
                                        'finalizado' => CoursesTypeEnum::FINALIZADO->value,
                                        'archivado' => CoursesTypeEnum::ARCHIVADO->value,
                                    ])
                                    ->default('pendiente'),

                                Forms\Components\DatePicker::make('startdate')
                                    ->label('Fecha inicio')
                                    ->required(),
                                Forms\Components\DatePicker::make('enddate')
                                    ->label('Fecha fin')
                                    ->required(),
                                    
                                Forms\Components\Select::make('CoursesClassEnum')
                                    ->label('Curso para')
                                    ->options([
                                        'ocupados' => CoursesClassEnum::OCUPADOS->value,
                                        'desempleados' => CoursesClassEnum::DESEMPLEADOS->value,
                                        'mujeres' => CoursesClassEnum::MUJERES->value,
                                        'otros' => CoursesClassEnum::OTROS->value,
                                    ]),
                                Forms\Components\Select::make('CoursesModoEnum')
                                    ->label('Modalidad')
                                    ->options([
                                        'teleformacion' => CoursesModoEnum::TELEFORMACION->value,
                                        'bimodal' => CoursesModoEnum::BIMODAL->value,
                                        'presencial' => CoursesModoEnum::PRESENCIAL->value,
                                    ]),
                            ])->columns(2)
                            
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                
                                Forms\Components\MarkdownEditor::make('comments')
                                    ->label('Observaciones')
                                    ->columnSpan('full'),
                                Forms\Components\FileUpload::make('picture')
                                    ->image()
                                    ->directory('pictures')
                                    ->disk('public')
                                    ->downloadable()
                                    ->imageEditor()
                                    ->columnSpan('full'),
                            ])->columns(3)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('picture')
                ->label('')
                ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
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
            ])
            ->filters([
                SelectFilter::make('CoursesClassEnum')
                ->label("Modalidad")
                ->options([
                    'Desempleados' => 'desempleados',
                    'Ocupados' => 'ocupados',
                    'Mujeres' => 'mujeres',
                    'Otros' => 'otros',
    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                //]),

            ]);
    }

   

    public static function getRelations(): array
    {
        
        return [
            RelationManagers\StudCursesRelationManager::class,
           
        ];
        
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourses::route('/create'),
            'edit' => Pages\EditCourses::route('/{record}/edit'),
        ];
    }
}
