<?php

namespace App\Filament\Resources;
use App\Enums\StudentsTypeEnum;
use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\RelationManagers;
use App\Models\Students;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;



class StudentsResource extends Resource
{
    protected static ?string $model = Students::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort=2;

    protected static ?string $navigationLabel = 'Alumnos';

    protected static ?string $modelLabel = 'Alumnos';
    
    public static ?string $navigationGroup='Gestión';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('removed')
                                    ->label('Baja'),
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->columnSpan('full')
                                    //->unique(ignoreRecord: true) // al editar que ignore el mismo registro
                                    ->maxValue(250)
                                    ->required(),
                                Forms\Components\TextInput::make('dni')
                                    ->label('Dni')
                                    ->maxValue(30),
                                Forms\Components\DatePicker::make('birthdate')
                                    ->label('Fecha nacimiento'),
                                Forms\Components\TextInput::make('cp')
                                    ->label('Codigo postal')
                                    ->maxValue(6),
                                Forms\Components\TextInput::make('addrres')
                                    ->label('Dirección'),
                                Forms\Components\TextInput::make('city')
                                    ->label('Población')
                                    ->maxValue(150),
                                Forms\Components\TextInput::make('province')
                                    ->label('Provincia')
                                    ->maxValue(150),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Teléfono')
                                    ->maxValue(100),
                                Forms\Components\Select::make('StudentsTypeEnum')
                                    ->label('Situación laboral')
                                    ->options([
                                        'ocupado' => StudentsTypeEnum::OCUPADO->value,
                                        'desempleado' => StudentsTypeEnum::DESEMPLEADO->value,
                                        'funcionario' => StudentsTypeEnum::FUNCIONARIO->value,
                                        
                                    ]), 
                                Forms\Components\TextInput::make('email')
                                    ->label('E-mail')
                                    ->maxValue(150)
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2)
                    ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                      
                                Forms\Components\TextInput::make('Estudios')
                                    ->label('Estudios')
                                    ->columnSpanFull(),
                                Forms\Components\Toggle::make('disable')
                                    ->label('Discapacitado'),
                                Forms\Components\TextInput::make('grade')
                                    ->label('Grado de discapacidad'), 
                                FileUpload::make('dnipdf')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->label('Guardar DNI en PDF')
                                    ->columnSpanFull()
                                    ->getUploadedFileNameForStorageUsing(
                                            function (TemporaryUploadedFile $file) {
                                                // Generar un número aleatorio, usando la función rand()
                                                $numeroAleatorio = rand(1000, 99999);

                                                // Agregar el número aleatorio al nombre del archivo original
                                                return 'Dni-' . $numeroAleatorio . '-' . $file->getClientOriginalName();
                                            }
                                        )
                                        ->directory('dni')
                                        ->disk('public')
                                        ->downloadable()
                                        ->openable()
                                        ,
                                Forms\Components\MarkdownEditor::make('comments')
                                    ->label('Observaciones')
                                    ->columnSpan('full'),

                            ])->columns(2)
                    ])
            ]);
    }

   

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('city')
                    ->label('Población')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono'),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail'),
                Tables\Columns\TextColumn::make('StudentsTypeEnum')
                    ->label('Situacion Laboral')
                    ->searchable()
                    ->sortable(),

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
            RelationManagers\StudCursesRelationManager::class,
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudents::route('/create'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
        ];
    }
}
