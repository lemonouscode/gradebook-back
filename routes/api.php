<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);



Route::get('/gradebooks', [GradebookController::class,'index']);

Route::get('/teachers', [UserController::class, 'index']);
Route::get('/teachers/{id}', [UserController::class, 'show']);


Route::post('/gradebooks', [GradebookController::class, 'store']);

Route::get('/gradebooksnoteacher', [GradebookController::class, 'getGradebookWithoutTeachers']);


route::get('/mygradebook/{id}', [GradebookController::class, 'myGradebook']);

route::post('/addnewstudent', [StudentsController::class, 'store']);


Route::get('/singlegradebook/{id}', [GradebookController::class, 'show']);


Route::delete('/gradebook/{id}', [GradebookController::class, 'destroy']);