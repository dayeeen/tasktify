<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/home', [TaskController::class, 'index'])->name('login')->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
// CRUD Task
Route::post('/create_task', [TaskController::class, 'store']);
Route::get('/search_task', [TaskController::class, 'searchTask']);
Route::post('/task_action', [TaskController::class, 'handleTaskAction']);
// Logout
Route::post('/logout', [LoginController::class, 'logout']);
