<?php

namespace Tests\Feature;

use function Pest\Livewire\livewire;

use App\Filament\Resources\StudentsResource\Pages\CreateStudents;
use App\Filament\Resources\StudentsResource\Pages\EditStudents;
use App\Filament\Resources\StudentsResource\Pages\ListStudents;
use App\Models\Students;


use function Pest\Laravel\get;


it('has students page',function(){
    
    get('students')
    ->assertStatus(200);
});

it('can view students',function(){
    $student=Students::limit(1)->get(); // Como tengo que aparezcan los que estan en curso y solo tengo 2 pues pongo 1
    
    livewire(ListStudents::class)
        ->assertCanSeeTableRecords($student);
});

it('has name column', function () {
    livewire(ListStudents::class)
        ->assertTableColumnExists('name');
});

it('can create students',function(){
    $newData=Students::factory()->count(1)->create()->first();
   
    livewire(CreateStudents::class)
        ->fillForm([
            'name'=>$newData->name,
            'dni' =>$newData->dni,
            'email' =>$newData->email,
            
        ])
        
        ->call('create')
        ->assertHasNoFormErrors();
        
       $this->assertDatabaseHas(Students::class,[
            'name'=>$newData->name,
            'dni' =>$newData->dni,
            'email' =>$newData->email,

       ]);
       

});

it('can edit students',function(){
    $newData=Students::factory()->count(1)->create()->first();
    livewire(EditStudents::class,[
        'record'=>$newData->getRouteKey(),
    ])
    ->assertFormSet([
        'name'=>$newData->name,
        'dni' =>$newData->dni,
        'email' =>$newData->email,
    ]);
});

it('items required',function(){
    livewire(CreateStudents::class)
    ->fillForm([
        'name'=>null,
        'email' =>null,
    ])
    ->call('create')
    ->assertHasFormErrors([
     'name' => 'required',
     'email' => 'required',
     
 ]);
});
