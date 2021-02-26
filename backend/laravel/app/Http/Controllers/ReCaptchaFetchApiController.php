<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReCaptchaFetchApiController extends Controller
{
    public function post(Request $request) {
        // reCaptchaのトークン認証を行う
        $client = new \GuzzleHttp\Client();


        // バージョンによってシークレットキーを変える
        $version = $request->version;
        if($version === 'V2') {
            $secret = config('app.RECAPTCHA_SECRET_KEY_V2');
        }
        if($version === 'V3') {
            $secret = config('app.RECAPTCHA_SECRET_KEY_V3');
        }
        // トークンの取得
        $token = $request->token;

        // トークンが無い場合
        if(!isset($token)){
            // tokenが無かった場合の処理
            return response()->json([
                'data' => '',
                'message' => 'The token is undefiend'
            ]);
        }

        // トークンのリクエスト
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
