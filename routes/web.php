<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/cargar', [CsvController::class, 'showUploadForm'])->name('cargar.form');
Route::post('/resultado', [CsvController::class, 'processUpload'])->name('cargar.process');
