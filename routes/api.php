<?php

use App\Http\Controllers\DataAnakController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataIbuController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\ImunisasiController;

Route::post('auth/register', [DataIbuController::class, 'register']);
Route::post('auth/login', [DataIbuController::class, 'login']);
Route::post('auth/check-email', [DataIbuController::class, 'checkEmail']);
Route::post('auth/change-password', [DataIbuController::class, 'changePassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [DataIbuController::class, 'me']);
    Route::post('auth/logout', [DataIbuController::class, 'logout']);
    Route::get('auth/dataProfile', [DataIbuController::class, 'dataProfile']);
    Route::post('auth/updateProfile', [DataIbuController::class, 'updateProfile']);
    Route::get('auth/anak',[DataAnakController::class, 'dataAnak']);
    Route::get('auth/dataGrafik',[DataAnakController::class, 'dataGrafik']);
});

Route::get('/edukasi', [EdukasiController::class, 'edukasi']);