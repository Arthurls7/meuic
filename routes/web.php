<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\ManageMonitorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainDashboardController::class, 'index']);
Route::get('/home', [MainDashboardController::class, 'index']);


Route::get('/profile', [ProfileController::class, 'getView']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('callbacks/google', [GoogleAuthController::class, 'handleCallback']);
Route::get('logout', [GoogleAuthController::class, 'logOut']);


// Route::get('/disciplinas',function(){
//     return view('manage_disciplina');
// });

Route::get('/disciplinas',[ManageMonitorController::class,'index']);
Route::post('/disciplinas',[ManageMonitorController::class, 'getMonitoresDisciplina']);
Route::post('/disciplinas/delete/{email}',[ManageMonitorController::class, 'destroy'])->name('monitor_delete');
Route::get('/disciplinas/find/{email}',[ManageMonitorController::class, 'getUserByEmail'])->name('monitor_find');
Route::get('/disciplinas/insert/{email}/{id_disciplina}',[ManageMonitorController::class, 'insert'])->name('monitor_insert');
