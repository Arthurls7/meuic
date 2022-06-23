<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainDashboardController;
use App\Http\Controllers\ManageMonitorController;
use App\Http\Controllers\ActivityController;

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
Route::get('/home', [MainDashboardController::class, 'index'])->name("home");

Route::get('/teste', [MainDashboardController::class, 'eloquentTest']);


Route::get('/profile', [ProfileController::class, 'getView']);
Route::post('/profile', [ProfileController::class, 'updateProfile']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('callbacks/google', [GoogleAuthController::class, 'handleCallback']);
Route::get('logout', [GoogleAuthController::class, 'logOut']);

Route::get('/monitors',function(){
    return view('manage_monitors');
});


// Route::get('/disciplinas',function(){
//     return view('manage_disciplina');
// });

Route::get('/disciplinas',[ManageMonitorController::class,'index']);

// testes

Route::get('/disciplinas/{idDisc}',[ManageMonitorController::class, 'getMonitoresDisciplina']);

Route::get('/activities',[ActivityController::class, 'index']);

Route::post('/activities/create', [ActivityController::class, 'insert']);

