<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\WhiteboardController;
use App\Http\Controllers\ActivityController;

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

//首頁
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

//任務管理功能
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/finish/{id}', [TaskController::class, 'finish'])->name('tasks.finish');
Route::get('/nofinish/{id}', [TaskController::class, 'nofinish'])->name('tasks.nofinish');
Route::post('/progress/{id}', [TaskController::class, 'progress'])->name('tasks.progress');

//待辦事項功能
Route::get('/lists/create', [TaskListController::class, 'create'])->name('lists.create');
Route::post('/lists', [TaskListController::class, 'store'])->name('lists.store');
Route::delete('/lists/{list}', [TaskListController::class, 'destroy'])->name('lists.destroy');

//白板管理功能
Route::get('/whiteboards/create', [WhiteboardController::class, 'create'])->name('whiteboards.create');
Route::post('/whiteboards', [WhiteboardController::class, 'store'])->name('whiteboards.store');
Route::delete('/whiteboards/{whiteboard}', [WhiteboardController::class, 'destroy'])->name('whiteboards.destroy');
Route::get('/whiteboards/{whiteboard}/edit', [WhiteboardController::class, 'edit'])->name('whiteboards.edit');
Route::put('/whiteboards/{whiteboard}', [WhiteboardController::class, 'update'])->name('whiteboards.update');

//活動管理功能
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
