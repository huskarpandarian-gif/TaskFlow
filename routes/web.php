<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::redirect('/', '/tasks');
Route::resource('tasks', TaskController::class);