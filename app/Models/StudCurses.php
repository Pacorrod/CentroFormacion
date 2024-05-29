<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\belongTo;

class StudCurses extends Model
{
    use HasFactory;

    protected $fillable =[
        'courses_id', 'students_id', 'documentation', 'comments', 'disable', 'datedisable', 'disablecomments',
        'subvencionable', 'nota'
    ];
    /**
     * Define la relación con el modelo Courses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courses(){
        return $this->belongsTo(Courses::class, 'courses_id');
    }
    /**
     * Define la relación con el modelo Students.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function students(){
        return $this->belongsTo(Students::class, 'students_id');
    }

}
