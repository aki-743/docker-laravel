<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RandomNumberGenerate extends Controller
{
    public function index() {
        // 乱数を生成し、ワンタイムトークンを作る
        $random = Str::random(128);

        return response()->json([
            'data' => $random,
            'message' => 'Generating random number is success'
        ]);
    }
}
