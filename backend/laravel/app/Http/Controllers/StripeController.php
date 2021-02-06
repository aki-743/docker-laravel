<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StripeController extends Controller
{
    public function show(Request $request) {
        require_once(__DIR__.'/../../../vendor/autoload.php');

        $subscription_id = $request->subscription_id;
        $trial_end_date = $request->trial_end_date;

        $stripe = new \Stripe\StripeClient("sk_test_51I7CTAKa0AMDYHAklEMevyf3JmvAa5xbFDmsEO1zt5rtD1zFWWko7aLPokJibLnPb8m1ZT0DGTs0rOfW80df4MOK00OGeJD093");
        $stripe->subscriptions->update(
            $subscription_id,
            ["trial_end" => $trial_end_date]
        );
        return response()->json([
            'message' => 'Update subscription is successfully',
        ], 200);
    }
}
