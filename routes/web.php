<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController,DropdownController};
use App\Models\User;

Route::get('/',[UserController::class,'index']);
Route::post('get-state',[DropdownController::class,'fetchState']);
Route::post('save-user',[UserController::class,'insert']);
Route::get('all-users',[userController::class,'allUsers']);
Route::get('update-user/{id}',[userController::class,'update']);
Route::get('delete-user/{id}',[UserController::class,'delete']);
Route::get('/export-users', [UserController::class, 'exportUsers'])->name('users.export');


