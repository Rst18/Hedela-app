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


Route::controller(App\Http\Controllers\RoleController::class)->group(function(){
    Route::get('role','create')->name('role');
    Route::post('role/add','store');
    Route::post('role/{role}/update','store');
    Route::post('role/set-role-user/{user}','addRoles');
    Route::post('role/remove-role-user/{user}','removeRoles');
});
Route::controller(App\Http\Controllers\Document::class)->group(function(){
    Route::get('document','create')->name('document');
    Route::post('document/add','store');
    Route::post('document/{document}/update','store');
});

Route::controller(App\Http\Controllers\ServiceController::class)->group(function(){
    Route::get('service','create')->name('service');
    Route::post('service/add','store');
    Route::post('service/{service}/update','store');
    Route::post('service/set-document-service/{service}','addDocument');
    Route::post('service/remove-document-service/{serveice}','removeDocument');
});

require __DIR__.'/auth.php';
