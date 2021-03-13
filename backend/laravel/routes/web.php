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
Route::get('/contact/login', [ContactBladeController::class, 'isAuth']);
Route::post('/contact/logged', [ContactBladeController::class, 'login']);
Route::post('/contact/logout', [ContactBladeController::class, 'logout']);
Route::get('/contact/list', [ContactBladeController::class, 'index']);
Route::post('/contact/delete', [ContactBladeController::class, 'store']);
Route::get('/contact/correspond', [ContactBladeController::class, 'show']);
Route::get('/qrcode/choice', function() {
  return view('qrcode.choice');
});
Route::post('qrcode/generate', [QrCodeController::class, 'generate']);