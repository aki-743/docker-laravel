<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\RandomNumberGenerate;
use App\Http\Controllers\ReCaptchaFetchApiController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('/events', EventsController::class);
Route::get('/participants', [ParticipantsController::class, 'index']);
Route::post('/participants', [ParticipantsController::class, 'store']);
Route::put('/participants', [ParticipantsController::class, 'update']);
Route::delete('/participants', [ParticipantsController::class, 'destroy']);
Route::get('/randomnumbergenerate', [RandomNumberGenerate::class, 'index']);
Route::post('/recaptchafetchapi', [ReCaptchaFetchApiController::class, 'post']);
Route::get('/stripe/{id}', [StripeController::class, 'show']);
Route::post('/stripe', [StripeController::class, 'store']);
Route::put('/stripe/{subscription_id}/{trial_end_date}', [StripeController::class, 'update']);
Route::post('/contact', [ContactController::class, 'store']);