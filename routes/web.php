<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendController;
use App\Http\Controllers\SendPubliController;


Route::get('download/{courses_id}', [PDFController::class,'downloadpdf'])->name('download.alumnos');

Route::get('send/{courses_id}', [SendController::class,'SendEmailStart'])->name('send.alumnos');

Route::get('sendPubli/{courses_id}', [SendPubliController::class,'SendEmailPubli'])->name('sendPubli.alumnos');