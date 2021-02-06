<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\RandomNumberGenerate;
use App\Http\Controllers\ReCaptchaFetchApiController;
use App\Http\Controllers\StripeController;

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
Route::put('/participants/{a}/{b}', [ParticipantsController::class, 'update']);
Route::delete('/participants', [ParticipantsController::class, 'destroy']);
Route::get('/randomnumbergenerate', [RandomNumberGenerate::class, 'index']);
Route::post('/recaptchafetchapi', [ReCaptchaFetchApiController::class, 'post']);
Route::put('/stripe/{subscription_id}/{trial_end_date}', [StripeController::class, 'show']);