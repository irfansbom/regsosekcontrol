<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KuesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\P_KabkotController;
use App\Http\Controllers\P_KosekaController;
use App\Http\Controllers\P_ProvController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SlsController;
use App\Http\Controllers\TargetCapaianController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('getkab', [HomeController::class, 'getkab']);
Route::get('getkec', [HomeController::class, 'getkec']);
Route::get('getdesa', [HomeController::class, 'getdesa']);
Route::get('getsls', [HomeController::class, 'getsls']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::resource('sls', SlsController::class);
    Route::resource('p_kabkot', P_KabkotController::class);
    Route::resource('p_provinsi', P_ProvController::class);

    Route::resource('box_besar', BoxController::class);
    Route::get('printbox/{id}', [BoxController::class, 'printbox']);
});

Route::group(['middleware' => ['role:SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT', 'auth']], function () {

    Route::resource('kues', KuesController::class);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users/update', [UserController::class, 'update']);
    Route::post('users/delete', [UserController::class, 'delete']);
    Route::post('/users/roles', [UserController::class, 'user_roles']);
    Route::post('/users/ubahpassword', [UserController::class, 'ubahpassword']);
});
Route::group(['middleware' => ['role:SUPER ADMIN', 'auth']], function () {
    Route::get('roles', [UserController::class, 'roles']);
    Route::post('roles/add', [UserController::class, 'roles_add']);
    Route::post('roles/edit', [UserController::class, 'roles_edit']);
    Route::post('roles/delete', [UserController::class, 'roles_delete']);
    Route::get('permissions', [UserController::class, 'permissions']);
    Route::post('permissions/add', [UserController::class, 'permissions_add']);
    Route::post('permissions/delete', [UserController::class, 'permissions_delete']);
});
