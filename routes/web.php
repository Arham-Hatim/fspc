<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\McqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('data/{sample}', 'DataSample')->name('DataSample');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::resource('category', CategoryController::class);
    Route::get('import/categories/form', [CategoryController::class, 'importForm'])->name('categoryImportFrom');
    Route::post('import/categories', [CategoryController::class, 'import'])->name('categoryImport');

    Route::resource('chapter', ChapterController::class);
    Route::get('import/chapter/form', [ChapterController::class, 'importForm'])->name('chapterImportFrom');
    Route::post('import/chapter', [ChapterController::class, 'import'])->name('chapterImport');

    Route::resource('mcq', McqController::class);
    Route::get('import/mcqs/form', [McqController::class, 'importForm'])->name('mcqImportFrom');
    Route::post('import/mcqs', [McqController::class, 'import'])->name('mcqImport');

});

Route::middleware(['guest:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('login', 'loginForm')->name('login');
        Route::post('authCheck', 'login')->name('authCheck');
    });

});
