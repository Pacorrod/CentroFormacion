<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Courses extends Model
{
    use HasFactory;
   

    protected $fillable =[
        'name', 'expedient', 'certificatecode', 'hours', 'startdate', 'enddate', 'comments', 'nstudents',
        'CoursesTypeEnum', 'CoursesModoEnum', 'CoursesClassEnum', 'picture', 'schedule'
    ];

    public function studCurses (): HasMany{
        return $this-> hasMany(StudCurses::class);
    }

    
}