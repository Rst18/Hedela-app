<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(App\Http\Controllers\RoleController::class)->middleware('auth')->group(function(){
    Route::get('role','create')->name('role');
    Route::post('role/add','store');
    Route::post('role/{role}/update','update');
    Route::post('role/set-role-user/{user}','addRoles');
    Route::post('role/remove-role-user/{user}','removeRoles');
});
Route::controller(App\Http\Controllers\DocumentController::class)->middleware('auth')->group(function(){
    Route::get('document','create')->name('document');
    Route::post('document/add','store');
    Route::post('document/{document}/update','update');
});

Route::controller(App\Http\Controllers\ServiceController::class)->middleware('auth')->group(function(){
    Route::get('service','create')->name('service');
    Route::post('service/add','store');
    Route::post('service/{service}/update','update');
    Route::post('service/set-document-service/{service}','addDocument');
    Route::post('service/remove-document-service/{service}','removeDocument');
});
Route::controller(App\Http\Controllers\TypeCourrierController::class)->middleware('auth')->group(function(){
    Route::get('typecourrier','create')->name('typecourrier');
    Route::post('typecourrier/add','store');
    Route::post('typecourrier/{typecourrier}/update','update');
});
Route::controller(App\Http\Controllers\CourrierController::class)->middleware('auth')->group(function(){
    Route::get('courrier','create')->name('courrier');
    Route::get('courrier/list','index')->name('courrier.lists');
    Route::post('courrier/add','store');
    Route::post('courrier/{courrier}/update','update');
});
Route::controller(App\Http\Controllers\CommentaireCourrierController::class)->middleware('auth')->group(function(){
    // Route::get('courrier','create')->name('courrier');
    // Route::get('courrier/list','index')->name('courrier.lists');
    Route::post('commentaire-courrier/add','store');
    // Route::post('courrier/{courrier}/update','update');
});
Route::controller(App\Http\Controllers\NoteTechniqueController::class)->middleware('auth')->group(function(){

    Route::post('note-technique/add','store');
});

require __DIR__.'/auth.php';
