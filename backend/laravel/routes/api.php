<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\RandomNumberGenerate;
use App\Http\Controllers\ReCaptchaFetchApiController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\PostalCodeController;

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
  Route::put('/stripe/trial', [StripeController::class, 'trialUpdate']);
  Route::put('/stripe/credit', [StripeController::class, 'creditUpdate']);
  Route::put('/stripe/subscription', [StripeController::class, 'subscriptionUpdate']);
  Route::post('/contact', [ContactController::class, 'store']);
  Route::post('/postal', [PostalCodeController::class, 'index']);
  Route::post('/qr/key1', [QrCodeController::class, 'confirmKey1']);
  Route::post('/qr/key2', [QrCodeController::class, 'confirmKey2']);
  Route::delete('/firebase/events', [FirebaseController::class, 'eventsDelete']);
  Route::delete('/firebase/qrs', [FirebaseController::class, 'qrsDelete']);