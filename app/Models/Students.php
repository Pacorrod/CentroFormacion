<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Students extends Model
{
    use HasFactory;

    protected $fillable =[
        'name', 'dni', 'cp', 'address', 'city', 'province', 'phone', 'email', 'birthdate', 'disable', 
        'grade', 'studentype', 'StudentsTypeEnum', 'dnipdf', 'comments','removed'
    ];

    public function studCurses (): HasMany{
        return $this-> hasMany(StudCurses::class);
    }
}
