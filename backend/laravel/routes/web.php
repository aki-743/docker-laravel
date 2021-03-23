<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactBladeController;
use App\Http\Controllers\QrCodeController;

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

Route::get('/', function() {
  return view('welcome');
});
Route::get('/login', [ContactBladeController::class, 'isAuth']);
Route::post('/logged', [ContactBladeController::class, 'login']);
Route::post('/logout', [ContactBladeController::class, 'logout']);
Route::get('/contact/list', [ContactBladeController::class, 'index']);
Route::post('/contact/delete', [ContactBladeController::class, 'store']);
Route::get('/contact/correspond', [ContactBladeController::class, 'show']);
Route::get('/qrcode/choice', [QrCodeController::class, 'choice']);
Route::post('qrcode/generate', [QrCodeController::class, 'generate']);