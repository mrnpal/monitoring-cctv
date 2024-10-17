<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IpController::class, 'index'])->name('ips.index');
Route::get('/ping/{ip}', [IpController::class, 'ping'])->name('ips.ping');
