<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\WhiteboardController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\TaskFileController;

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
Route::post('/tasks/{id}/finish', [TaskController::class, 'finish'])->name('tasks.finish');
Route::post('/tasks/{id}/nofinish', [TaskController::class, 'nofinish'])->name('tasks.nofinish');
Route::post('/progress/{id}', [TaskController::class, 'progress'])->name('tasks.progress');

// 上傳檔案
Route::post('/tasks/{taskId}/files', [TaskFileController::class, 'store'])->name('tasks.files.store');
// 下載檔案
Route::get('/files/{id}/download', [TaskFileController::class, 'download'])->name('tasks.files.download');
// 刪除檔案
Route::delete('/files/{id}', [TaskFileController::class, 'destroy'])->name('tasks.files.destroy');

//添加成員功能
Route::post('/tasks/{id}/members', [MemberController::class, 'store'])->name('members.store');
Route::delete('/tasks/{id}/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

//添加註記功能
Route::post('/tasks/{id}/remarks', [RemarkController::class, 'store'])->name('remarks.store');
Route::delete('/tasks/{id}/remarks/{remark}', [RemarkController::class, 'destroy'])->name('remarks.destroy');

//待辦事項功能
Route::post('/lists', [TaskListController::class, 'store'])->name('lists.store');
Route::delete('/lists/{list}', [TaskListController::class, 'destroy'])->name('lists.destroy');

//白板管理功能
Route::post('/whiteboards', [WhiteboardController::class, 'store'])->name('whiteboards.store');
Route::delete('/whiteboards/{whiteboard}', [WhiteboardController::class, 'destroy'])->name('whiteboards.destroy');

//活動管理功能
Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');