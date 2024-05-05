<?php

namespace Tests\Feature;

use function Pest\Livewire\livewire;

use App\Filament\Resources\CoursesResource\Pages\CreateCourses;
use App\Filament\Resources\CoursesResource\Pages\EditCourses;
use App\Filament\Resources\CoursesResource\Pages\ListCourses;
use App\Models\Courses;


use function Pest\Laravel\get;


it('has courses page',function(){
    
    get('courses')
    ->assertStatus(200);
});

it('can view courses',function(){
    $cursos=Courses::limit(1)->get(); // Como tengo que aparezcan los que estan en curso y solo tengo 2 pues pongo 1
    
    livewire(ListCourses::class)
        ->assertCanSeeTableRecords($cursos);
});

it('has name column', function () {
    livewire(ListCourses::class)
        ->assertTableColumnExists('name');
});

it('can create courses',function(){
    $newData=Courses::factory()->count(1)->create()->first();
   
    livewire(CreateCourses::class)
        ->fillForm([
            'name'=>$newData->name,
            'startdate' =>$newData->startdate,
            'enddate' =>$newData->enddate,
            'hours' =>$newData->hours,
            'nstudents' =>$newData->nstudents,
            'CoursesTypeEnum'=>$newData->CoursesTypeEnum,
            

        ])
        
        ->call('create')
        ->assertHasNoFormErrors();
        
       $this->assertDatabaseHas(Courses::class,[
        'name'=>$newData->name,
        'startdate' =>$newData->startdate,
        'enddate' =>$newData->enddate,
        'hours' =>$newData->hours,
        'nstudents' =>$newData->nstudents,
        'CoursesTypeEnum'=>$newData->CoursesTypeEnum,
        
       ]);
       

});

it('can edit courses',function(){
    $newData=Courses::factory()->count(1)->create()->first();
    livewire(EditCourses::class,[
        'record'=>$newData->getRouteKey(),
    ])
    ->assertFormSet([
        'name'=>$newData->name,
        'startdate' =>$newData->startdate,
        'enddate' =>$newData->enddate,
        'hours' =>$newData->hours,
        'nstudents' =>$newData->nstudents,
        'CoursesTypeEnum'=>$newData->CoursesTypeEnum,
        
    ]);
});

it('items required',function(){
    livewire(CreateCourses::class)
    ->fillForm([
        'name' => null,
        'startdate' =>null,
        'enddate' =>null,
        'hours' => null,
        'nstudents' => null,
    ])
    ->call('create')
    ->assertHasFormErrors([
     'name' => 'required',
     'startdate' => 'required',
     'enddate' => 'required',
     'hours' =>'required',
     'nstudents' => 'required',
 ]);
});
