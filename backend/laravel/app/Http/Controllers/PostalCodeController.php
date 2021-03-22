<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    public function index(Request $request) {
        // 郵便番号から住所を取得
        $client = new \GuzzleHttp\Client();

        $postalCode = $request->postalcode;

        $response = $client->request(
            'GET',
            'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $postalCode
        );

        return response()->json([
            'data' => $response->getBody()->getContents(),
            'message' => 'Getting recapcha`s score is success'
        ]);
    }
}
