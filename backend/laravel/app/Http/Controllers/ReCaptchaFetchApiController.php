<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReCaptchaFetchApiController extends Controller
{
    public function post(Request $request) {
        // reCaptchaのトークン認証を行う
        $client = new \GuzzleHttp\Client();

        // シークレットキー、トークン
        $secret = config('app.RECAPTCHA_SECRET_KEY');
        $token = $request->token;

        // トークンが無い場合
        if(!isset($token)){
            // tokenが無かった場合の処理
            return response()->json([
                'data' => '',
                'message' => 'The token is undefiend'
            ]);
        }

        $response = $client->request(
            'POST',
            'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $token, // URLを設定
        );

        return response()->json([
            'data' => $response->getBody()->getContents(),
            'message' => 'Getting recapcha`s score is success'
        ]);
    }
}
