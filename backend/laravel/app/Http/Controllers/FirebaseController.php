<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirebaseController extends Controller
{
    public function delete (Request $request) {
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        if ($request->username === $username && $request->password === $password) {
            DB::table('qrs')->truncate();
            return response()->json([
                'message' => 'Truncating key`s information is success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Truncating key`s information is failed'
            ], 400);
        }
    }
}
