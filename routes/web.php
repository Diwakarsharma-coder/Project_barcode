<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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




Route::group(['middleware'=>'guest'], function () {

Route::get('/',[UserController::class,'welcome'] )->name('welcome');
Route::get('{id}'.base64_encode('/viewDataUserDetails/'),[UserController::class,'view'])->name('view');


Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/registerData',[UserController::class,'store'])->name('registerData');

Route::get('/login',[UserController::class,'login'])->name('login');

Route::post('datalogn',[UserController::class,'datalogin'])->name('Datalogin');


});




Route::group(['middleware'=>'auth'], function () {

Route::get('home', [UserController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('edit/',[UserController::class,'editProfile'])->name('editProfile');

Route::get('{id}/edit-profile/',[UserController::class,'edit'])->name('edit');

Route::post('{id}'.base64_encode('/updateDataUserDetails/'),[UserController::class,'update'])->name('updateData');
});